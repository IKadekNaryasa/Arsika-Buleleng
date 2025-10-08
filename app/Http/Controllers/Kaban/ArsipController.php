<?php

namespace App\Http\Controllers\Kaban;

use App\Models\Arsip;
use setasign\Fpdi\Fpdi;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Psy\Exception\Exception;

use App\Http\Controllers\Controller;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


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
        return view('kaban.arsip.index', $data);
    }

    public function arsipBelumLegal()
    {
        $arsips = Arsip::with('user.bidang')->where('status_legalisasi', '=', 'onProgress')->latest()->get();
        $data = [
            'active' => 'dataArsipBelumLegal',
            'open' => 'arsip',
            'link' => 'Arsip | Data Arsip Belum Legalisasi',
            'arsips' => $arsips
        ];
        return view('kaban.arsip.belumLegal', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    public function legalisasi(Request $request)
    {
        $sanitize = [
            'kode_arsip' => e($request->kode_arsip)
        ];

        $validator = Validator::make($sanitize, [
            'kode_arsip' => 'required|exists:arsips,kode_arsip'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $credential = $validator->validate();
        $kode_arsip = e($credential['kode_arsip']);

        $arsip = Arsip::with('user.bidang')->where('kode_arsip', '=', $kode_arsip)->firstOrFail();
        $pdfSource = storage_path('app/temp_' . Str::random(10) . '.pdf');
        file_put_contents($pdfSource, Storage::disk('google')->get($arsip->path_file));

        $outputPdf = storage_path('app/legalized_' . Str::random(10) . '.pdf');
        $qrImage   = storage_path('app/temp_qr.png');

        $qrContent = $arsip->kode_arsip . ' | ' . $arsip->kategori . ' | ' . $arsip->tanggal_arsip . ' | ' . $arsip->user->bidang->kode_bidang;
        $qrCode = new QrCode($qrContent);
        $qrCode->setSize(100);

        $writer = new PngWriter();
        $writer->write($qrCode)->saveToFile($qrImage);

        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($pdfSource);

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $tplIdx = $pdf->importPage($pageNo);
            $size   = $pdf->getTemplateSize($tplIdx);

            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($tplIdx);

            $x = $size['width'] - 20;
            $y = 0;
            $pdf->Image($qrImage, $x, $y, 20, 20);
        }

        $pdf->Output($outputPdf, 'F');


        $fileName = 'Legal/' . $kode_arsip . '-' . $arsip->nama_file;
        Storage::disk('google')->put($fileName, file_get_contents($outputPdf));

        Storage::disk('google')->delete($arsip->path_file);

        $arsip->update([
            'path_file' => $fileName,
            'status_legalisasi' => 'legal'
        ]);

        unlink($pdfSource);
        unlink($outputPdf);
        unlink($qrImage);

        return redirect()->back()->with('success', 'Legalisasi Berhasil!');
    }
}
