<?php

namespace App\Http\Controllers\Admin;

use App\Models\Arsip;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Psy\Exception\Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arsips = Arsip::with('user.bidang')->latest()->get();
        $data = [
            'active' => 'dataArsip',
            'open' => 'arsip',
            'link' => 'Arsip | Data Arsip',
            'arsips' => $arsips
        ];
        return view('admin.arsip.index', $data);
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
        return view('admin.arsip.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            $request->validate([
                'kategori_arsip' => 'required|in:arsip_aktif,arsip_inAktif,lainnya',
                'kode_klasifikasi' => 'required|string|max:255',
                'tanggal_arsip' => 'required|date',
                'nama_file' => 'required|mimes:pdf|max:20240',
                'uraian' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('arsip.create')->withErrors(['errors' => $e->errors()])->withInput();
        }

        try {
            $user_id = Auth::user()->id;
            $bidang = Auth::user()->bidang->kode_bidang;
            $kodeArsip = 'ARSP-BKBP-' . $bidang . '-' . str_replace('-', '', $request->tanggal_arsip) . '-' . uniqid();
            $file = $request->file('nama_file');
            $originalFileName = $file->getClientOriginalName();
            $fileName = $kodeArsip . '_' . $originalFileName;

            $folderPath = "Belum_dilegalisasi";
            $filePath = $folderPath . '/' . $fileName;


            try {
                Storage::disk('google')->put('test.txt', 'test content');
                Storage::disk('google')->delete('test.txt');
                // Log::info('Google Drive connection test: SUCCESS');
            } catch (\Exception $testError) {
                return redirect()->route('arsip.create')->withErrors(['errors' => 'Gagal terhubung ke Drive!'])->withInput();
            }

            $uploaded = Storage::disk('google')->put($filePath, file_get_contents($file));

            if ($uploaded) {
                // Log::info('File berhasil diupload ke Google Drive');

                Arsip::create([
                    'kode_arsip' => $kodeArsip,
                    'kategori' => $request->kategori_arsip,
                    'kode_klasifikasi' => $request->kode_klasifikasi,
                    'tanggal_arsip' => $request->tanggal_arsip,
                    'nama_file' => $originalFileName,
                    'uraian' => $request->uraian,
                    'path_file' => $filePath,
                    'status_legalisasi' => 'onProgress',
                    'user_id' => $user_id,
                ]);


                // return response()->json([
                //     'status' => 'success',
                //     'message' => 'Arsip berhasil ditambahkan dan diupload ke Google Drive',
                //     'data' => [
                //         'kode_arsip' => $kodeArsip,
                //         'nama_file' => $originalFileName,
                //         'path_file' => $filePath
                //     ]
                // ], 200);

                return redirect()->route('arsip.index')->with('success', 'Arsip Berhasil ditambahkan!');
            } else {
                return redirect()->route('arsip.create')->withErrors(['errors' => 'Gagal menambahkan arsip!'])->withInput();
            }
        } catch (\Exception $e) {

            return redirect()->route('arsip.create')->withErrors(['errors' => 'Gagal Upload  arsip!'])->withInput();

            // Log::error('Error upload arsip:', [
            //     'message' => $e->getMessage(),
            //     'file' => $e->getFile(),
            //     'line' => $e->getLine(),
            //     'trace' => $e->getTraceAsString()
            // ]);

            // return response()->json([
            //     'status' => 'error',
            //     'message' => 'Gagal upload file: ' . $e->getMessage(),
            //     'debug_info' => config('app.debug') ? [
            //         'error' => $e->getMessage(),
            //         'file' => $e->getFile(),
            //         'line' => $e->getLine()
            //     ] : null
            // ], 500);
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
        //
    }
}
