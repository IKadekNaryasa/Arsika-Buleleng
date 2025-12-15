<?php

namespace App\Http\Controllers\Operator;

use App\Models\User;
use App\Models\Arsip;
use App\Models\Bidang;
use App\Helpers\PdfHelper;
use Illuminate\Http\Request;
use Psy\Exception\Exception;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\KodeKlasifikasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bidangId = Auth::user()->bidang_id;
        $legalizers = User::where('bidang_id', $bidangId)->where('role', 'legalizer')->get();
        $sekbans = User::where('role', 'sekban')->get();

        $arsips = Arsip::with(['user.bidang', 'kodeKlasifikasi'])->whereHas('user', function ($query) use ($bidangId) {
            $query->where('bidang_id', $bidangId);
        })->latest()->get();

        $data = [
            'active' => 'dataArsip',
            'open' => 'arsip',
            'link' => 'Arsip | Data Arsip',
            'arsips' => $arsips,
            'sekbans' => $sekbans,
            'legalizer' => $legalizers
        ];
        return view('operator.arsip.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bidangs = Bidang::all();
        $klasifikasies = KodeKlasifikasi::all();
        $data = [
            'active' => 'createArsip',
            'open' => 'arsip',
            'link' => 'Arsip | Tambah Arsip',
            'bidangs' => $bidangs,
            'klasifikasies' => $klasifikasies
        ];
        return view('operator.arsip.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        try {
            $rules = [
                'kategori_arsip' => 'required|in:arsip_aktif,arsip_inAktif,lainnya',
                'klasifikasi_id' => 'required|string|max:255',
                'tanggal_arsip' => 'required|date',
                'nama_file' => 'required|mimes:pdf|max:3072',
                'uraian' => 'required|string',
                'type' => 'required|string|in:asli,copy',
                'masa_aktif' => 'required|numeric',
                'nomor_dokumen' => 'required|string|unique:arsips,nomor_dokumen',
            ];

            $messages = [
                'kategori_arsip.required' => 'Kategori arsip wajib dipilih.',
                'kategori_arsip.in' => 'Kategori arsip tidak valid.',
                'klasifikasi_id.required' => 'Kode klasifikasi wajib diisi.',
                'klasifikasi_id.max' => 'Kode klasifikasi tidak boleh lebih dari 255 karakter.',
                'tanggal_arsip.required' => 'Tanggal arsip wajib diisi.',
                'tanggal_arsip.date' => 'Tanggal arsip harus berupa format tanggal yang valid.',
                'nama_file.required' => 'File arsip wajib diunggah.',
                'nama_file.mimes' => 'File arsip harus berformat PDF.',
                'nama_file.max' => 'Ukuran file arsip tidak boleh lebih dari 3 MB.',
                'uraian.required' => 'Uraian arsip wajib diisi.',
                'type.required' => 'Jenis file arsip wajib dipilih.',
                'type.in' => 'Jenis file arsip tidak valid.',
                'masa_aktif.required' => 'Masa aktif wajib diisi!',
                'masa_aktif.numeric' => 'Masa aktif harus berupa angka!',
                'nomor_dokumen.required' => 'Nomor dokumen wajib diisi!',
                'nomor_dokumen.string' => 'Nomor dokumen harus berupa text!',
                'nomor_dokumen.unique' => 'Nomor dokumen sudah ada!'
            ];

            $request->validate($rules, $messages);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('arsip.create')
                ->withErrors($e->errors())
                ->withInput();
        }


        try {
            try {
                $token = DB::table('google_access_tokens')->where('id', 1)->value('access_token');
                config(['filesystems.disks.google.accessToken' => $token]);
                Storage::disk('google')->put('test.txt', 'test content');
                Storage::disk('google')->delete('test.txt');
            } catch (\Exception $testError) {
                return redirect()->route('arsip.create')
                    ->withErrors(['errors' => 'Gagal terhubung ke Drive!'])
                    ->withInput();
            }

            $user_id = Auth::user()->id;
            $bidang = Auth::user()->bidang->kode_bidang;

            $kodeArsip = 'ARSP-BKBP' . '-' . $bidang . '-' . str_replace('-', '', $request->tanggal_arsip) . '-' . uniqid();

            $file = $request->file('nama_file');
            $originalFileName = $file->getClientOriginalName();
            $fileName = $kodeArsip . '_' . $originalFileName;

            $folderPath = "Belum_dilegalisasi";
            $filePath = $folderPath . '/' . $fileName;

            $tempPath = storage_path("app/temp_" . uniqid() . ".pdf");
            $file->move(dirname($tempPath), basename($tempPath));

            $convertedPath = storage_path("app/converted_" . uniqid() . ".pdf");

            try {
                PdfHelper::convertToPdf14($tempPath, $convertedPath);
                Log::info("Ghostscript berhasil convert PDF");
                $finalPath = $convertedPath;
            } catch (\Throwable $e) {
                Log::warning("Ghostscript gagal convert PDF: " . $e->getMessage());
                $finalPath = $tempPath;
            }

            $uploaded = Storage::disk('google')->put($filePath, file_get_contents($finalPath));

            @unlink($tempPath);
            @unlink($convertedPath);

            if ($uploaded) {
                Arsip::create([
                    'kode_arsip' => $kodeArsip,
                    'kategori' => e($request->kategori_arsip),
                    'klasifikasi_id' => e($request->klasifikasi_id),
                    'tanggal_arsip' => e($request->tanggal_arsip),
                    'nama_file' => $originalFileName,
                    'uraian' => e($request->uraian),
                    'path_file' => $filePath,
                    'status_legalisasi' => 'onProgress',
                    'user_id' => $user_id,
                    'type' => e($request->type),
                    'masa_aktif' => strip_tags($request->masa_aktif),
                    'nomor_dokumen' => strip_tags($request->nomor_dokumen),
                ]);

                return redirect()->route('arsip.index')
                    ->with('success', 'Berhasil menambahkan arsip!');
            } else {
                return redirect()->route('arsip.create')
                    ->withErrors(['errors' => 'Gagal upload file ke Google Drive!'])
                    ->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->route('arsip.create')
                ->withErrors(['errors' => 'Terjadi kesalahan sistem: ' . $e->getMessage()])
                ->withInput();
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Arsip $arsip)
    {
        try {
            $filePath = $arsip->path_file;

            if (empty($filePath)) {
                abort(404, 'Path file tidak ditemukan dalam database');
            }

            if (!Storage::disk('google')->exists($filePath)) {
                abort(404, 'File tidak ditemukan di Google Drive: ' . $filePath);
            }

            $fileContent = Storage::disk('google')->get($filePath);

            $originalExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            $mimeType = $this->getMimeTypeByExtension($originalExtension);

            $fileName = $arsip->kode_arsip . '.' . $originalExtension;

            return response($fileContent)
                ->header('Content-Type', $mimeType)
                ->header('Content-Disposition', 'inline; filename="' . $fileName . '"')
                ->header('X-Frame-Options', 'SAMEORIGIN')
                ->header('Content-Description', 'File Transfer')
                ->header('Cache-Control', 'public, max-age=3600')
                ->header('Pragma', 'public');
        } catch (Exception $e) {
            abort(404, 'Path file tidak ditemukan dalam database');
        }
    }

    private function getMimeTypeByExtension($extension)
    {
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'txt' => 'text/plain',
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
        ];

        return $mimeTypes[$extension] ?? 'application/octet-stream';
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Arsip $arsip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Arsip $arsip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Arsip $arsip)
    {
        try {
            $filePath = $arsip->path_file;

            $fileDeleted = false;;
            if ($filePath) {
                try {
                    if (Storage::disk('google')->exists($filePath)) {
                        $fileDeleted = Storage::disk('google')->delete($filePath);
                    } else {
                        $fileDeleted = true;
                    }
                } catch (Exception $e) {
                    return redirect()->route('arsip.index')
                        ->withErrors(['errors' => 'Gagal menghapus file dari Google Drive']);
                }
            } else {
                $fileDeleted = true;
            }

            $arsip->delete();

            return redirect()->route('arsip.index')->with('success', 'Data dan File berhasil dihapus!');
        } catch (Exception $e) {
            return redirect()->route('arsip.index')->withErrors(['errors' => 'Gagal menghapus data!']);
        }
    }


    public function cetak(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required|numeric',
            'sekban' => 'required|string',
            'legalizer' => 'required'
        ], [
            'tahun.required' => 'The year is required',
            'tahun.numeric' => 'The year must be a number',
            'sekban.required' => 'The sekban is required',
            'sekban.string' => 'The sekban must be a string',
            'legalizer.required' => 'The legalizer is required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $credential = $validator->validated();

        $tahun = $credential['tahun'];
        $sekban = $credential['sekban'];
        $legalizerId = $credential['legalizer'];
        $user = User::where('id', $legalizerId)->firstOrFail();
        $legalizer = $user->name;
        $jabatan = $user->jabatan;

        $bidangId = Auth::user()->bidang_id;
        $bidangNama = Auth::user()->bidang->nama_bidang ?? 'Bidang';
        $kodeBidang = Auth::user()->bidang->kode_bidang;

        $arsips = Arsip::with(['kodeKlasifikasi', 'user'])
            ->whereHas('user', function ($query) use ($bidangId) {
                $query->where('bidang_id', $bidangId);
            })
            ->whereYear('tanggal_arsip', $tahun)
            ->get();

        $grouped = $arsips->groupBy(function ($item) {
            return $item->kodeKlasifikasi->kode . '|' . $item->type;
        });

        $formattedData = [];
        $grandTotal = 0;
        $nomorUrut = 1;

        foreach ($grouped as $key => $items) {
            list($kodeKlasifikasi, $type) = explode('|', $key);
            $jumlah = $items->count();
            $grandTotal += $jumlah;

            $formattedData[] = [
                'no' => $nomorUrut++,
                'kode_klasifikasi' => $kodeKlasifikasi,
                'uraian' => $items->first()->uraian,
                'keterangan' => $items->first()->klasifikasi->keterangan ?? '',
                'kurun_waktu' => $tahun,
                'jumlah' => $jumlah,
                'ket' => ucfirst($type)
            ];
        }

        usort($formattedData, function ($a, $b) {
            return strcmp($a['kode_klasifikasi'], $b['kode_klasifikasi']);
        });

        foreach ($formattedData as $index => &$item) {
            $item['no'] = $index + 1;
        }

        $pdf = PDF::loadView('operator.arsip.cetak_laporan', [
            'dataLaporan' => $formattedData,
            'grandTotal' => $grandTotal,
            'tahun' => $tahun,
            'bidangNama' => $bidangNama,
            'legalizer' => $legalizer,
            'sekban' => $sekban,
            'jabatan' => $jabatan,
            'nip' => $user->nip,
            'tanggalCetak' => now()->format('d-m-Y')
        ]);

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan-Arsip-' . $kodeBidang . '-' . $tahun . '.pdf');
    }
}
