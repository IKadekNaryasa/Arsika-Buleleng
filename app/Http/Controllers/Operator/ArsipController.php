<?php

namespace App\Http\Controllers\Operator;

use App\Models\Arsip;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Psy\Exception\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Helpers\PdfHelper;


class ArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bidangId = Auth::user()->bidang_id;

        $arsips = Arsip::with('user.bidang')->whereHas('user', function ($query) use ($bidangId) {
            $query->where('bidang_id', $bidangId);
        })->latest()->get();

        $data = [
            'active' => 'dataArsip',
            'open' => 'arsip',
            'link' => 'Arsip | Data Arsip',
            'arsips' => $arsips
        ];
        return view('operator.arsip.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bidangs = Bidang::all();
        $data = [
            'active' => 'createArsip',
            'open' => 'arsip',
            'link' => 'Arsip | Tambah Arsip',
            'bidangs' => $bidangs
        ];
        return view('operator.arsip.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        try {
            $rules = [];
            $arsipData = $request->input('arsip', []);

            foreach ($arsipData as $index => $data) {
                $rules["arsip.{$index}.kategori_arsip"] = 'required|in:arsip_aktif,arsip_inAktif,lainnya';
                $rules["arsip.{$index}.kode_klasifikasi"] = 'required|string|max:255';
                $rules["arsip.{$index}.tanggal_arsip"] = 'required|date';
                $rules["arsip.{$index}.nama_file"] = 'required|mimes:pdf|max:20240';
                $rules["arsip.{$index}.uraian"] = 'required|string';
                $rules["arsip.{$index}.type"] = 'required|string';
            }

            $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('arsip.create')
                ->withErrors(['errors' => $e->errors()])
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
            $successCount = 0;
            $failedFiles = [];

            foreach ($arsipData as $index => $data) {
                try {
                    $kodeArsip = 'ARSP-BKBP-' . $bidang . '-' . str_replace('-', '', $data['tanggal_arsip']) . '-' . uniqid();

                    $file = $request->file("arsip.{$index}.nama_file");
                    $originalFileName = $file->getClientOriginalName();
                    $fileName = $kodeArsip . '_' . $originalFileName;

                    $folderPath = "Belum_dilegalisasi";
                    $filePath = $folderPath . '/' . $fileName;

                    $tempPath = storage_path("app/temp_" . uniqid() . ".pdf");
                    $file->move(dirname($tempPath), basename($tempPath));

                    $convertedPath = storage_path("app/converted_" . uniqid() . ".pdf");

                    try {
                        PdfHelper::convertToPdf14($tempPath, $convertedPath);
                        Log::info("Ghostscript berhasil convert PDF ");
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
                            'kategori' => e($data['kategori_arsip']),
                            'kode_klasifikasi' => e($data['kode_klasifikasi']),
                            'tanggal_arsip' => e($data['tanggal_arsip']),
                            'nama_file' => $originalFileName,
                            'uraian' => e($data['uraian']),
                            'path_file' => $filePath,
                            'status_legalisasi' => 'onProgress',
                            'user_id' => $user_id,
                            'type' => e($data['type'])
                        ]);

                        $successCount++;
                    } else {
                        $failedFiles[] = $originalFileName;
                    }
                } catch (\Exception $e) {
                    $failedFiles[] = $data['nama_file'] ?? "File #" . ($index + 1);
                }
            }

            if ($successCount > 0 && empty($failedFiles)) {
                return redirect()->route('arsip.index')
                    ->with('success', "Berhasil menambahkan {$successCount} arsip!");
            } elseif ($successCount > 0 && !empty($failedFiles)) {
                $failedList = implode(', ', $failedFiles);
                return redirect()->route('arsip.index')
                    ->with('warning', "Berhasil menambahkan {$successCount} arsip. Gagal upload: {$failedList}");
            } else {
                return redirect()->route('arsip.create')
                    ->withErrors(['errors' => 'Semua file gagal diupload!'])
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
            $fileName = $arsip->nama_file;
            $kodeArsip = $arsip->kode_arsip;

            $fileDeleted = false;;
            if ($filePath) {
                try {
                    if (Storage::disk('google')->exists($filePath)) {
                        $fileDeleted = Storage::disk('google')->delete($filePath);
                    } else {
                        $fileDeleted = true;
                    }
                } catch (\Exception $driverError) {
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
}
