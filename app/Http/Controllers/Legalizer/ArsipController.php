<?php

namespace App\Http\Controllers\Legalizer;

use App\Models\Arsip;
use setasign\Fpdi\Fpdi;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Psy\Exception\Exception;

use App\Http\Controllers\Controller;
use Endroid\QrCode\Writer\PngWriter;
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
        $arsips = Arsip::with('user.bidang', 'kodeKlasifikasi')->whereHas('user', function ($query) use ($bidangId) {
            $query->where('bidang_id', $bidangId);
        })->latest()->get();
        $data = [
            'active' => 'dataArsip',
            'open' => 'arsip',
            'link' => 'Arsip | Data Arsip',
            'arsips' => $arsips
        ];
        return view('legalizer.arsip.index', $data);
    }

    public function arsipBelumLegal()
    {
        $bidangId = Auth::user()->bidang_id;
        $arsips = Arsip::with('user.bidang', 'kodeKlasifikasi')->whereHas('user', function ($query) use ($bidangId) {
            $query->where('bidang_id', $bidangId);
            $query->where('status_legalisasi', 'onProgress');
        })->latest()->get();
        $data = [
            'active' => 'dataArsipBelumLegal',
            'open' => 'arsip',
            'link' => 'Arsip | Data Arsip Belum Legalisasi',
            'arsips' => $arsips
        ];
        return view('legalizer.arsip.belumLegal', $data);
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
        ], [
            'kode_arsip.required' => 'The archive code is required',
            'kode_arsip.exists' => 'The archive code does not exist',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credential = $validator->validated();
        $kode_arsip = e($credential['kode_arsip']);

        $arsip = Arsip::with('user.bidang')->where('kode_arsip', '=', $kode_arsip)->firstOrFail();
        $pdfSource = storage_path('app/temp_' . Str::random(10) . '.pdf');
        file_put_contents($pdfSource, Storage::disk('google')->get($arsip->path_file));

        $outputPdf = storage_path('app/legalized_' . Str::random(10) . '.pdf');
        $qrImageWatermark = storage_path('app/temp_qr_watermark.png');
        $qrImageSmall = storage_path('app/temp_qr_small.png');

        $qrContent = route('arsip.cekLegalisasi', $arsip->id);

        $qrCodeWatermark = QrCode::create($qrContent)
            ->setSize(300)
            ->setMargin(10)
            ->setErrorCorrectionLevel(new \Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh());

        $logoPath = public_path('img/logo.png');
        $logoWatermark = \Endroid\QrCode\Logo\Logo::create($logoPath)
            ->setResizeToWidth(60);

        $writer = new PngWriter();
        $result = $writer->write($qrCodeWatermark, $logoWatermark);
        $result->saveToFile($qrImageWatermark);

        $this->makeImageTransparent($qrImageWatermark, 0.2);

        $qrCodeSmall = QrCode::create($qrContent)
            ->setSize(120)
            ->setMargin(10)
            ->setErrorCorrectionLevel(new \Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh());

        $logoSmall = \Endroid\QrCode\Logo\Logo::create($logoPath)
            ->setResizeToWidth(20);

        $resultSmall = $writer->write($qrCodeSmall, $logoSmall);
        $resultSmall->saveToFile($qrImageSmall);

        $this->makeImageTransparent($qrImageSmall, 0.7);

        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($pdfSource);

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $tplIdx = $pdf->importPage($pageNo);
            $size   = $pdf->getTemplateSize($tplIdx);

            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($tplIdx);

            $qrDisplaySize = 80;
            $x = ($size['width'] - $qrDisplaySize) / 2;
            $y = ($size['height'] - $qrDisplaySize) / 2;
            $pdf->Image($qrImageWatermark, $x, $y, $qrDisplaySize, $qrDisplaySize);

            if ($pageNo == $pageCount) {
                $xSmall = $size['width'] - 25;
                $ySmall = 5;

                $pdf->Image($qrImageSmall, $xSmall, $ySmall, 20, 20);
            }
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
        unlink($qrImageWatermark);
        unlink($qrImageSmall);

        return redirect()->back()->with('success', 'Legalisasi Berhasil!');
    }

    private function makeImageTransparent($imagePath, $opacity = 0.3)
    {
        $image = imagecreatefrompng($imagePath);

        $width = imagesx($image);
        $height = imagesy($image);

        $transparent = imagecreatetruecolor($width, $height);

        imagealphablending($transparent, false);
        imagesavealpha($transparent, true);

        $transparentColor = imagecolorallocatealpha($transparent, 255, 255, 255, 127);
        imagefill($transparent, 0, 0, $transparentColor);

        imagealphablending($transparent, true);

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $rgb = imagecolorat($image, $x, $y);
                $colors = imagecolorsforindex($image, $rgb);

                $newAlpha = 127 - (127 * $opacity);

                if ($colors['red'] < 128 && $colors['green'] < 128 && $colors['blue'] < 128) {
                    $newColor = imagecolorallocatealpha(
                        $transparent,
                        $colors['red'],
                        $colors['green'],
                        $colors['blue'],
                        $newAlpha
                    );
                    imagesetpixel($transparent, $x, $y, $newColor);
                } else {
                    $whiteTransparent = imagecolorallocatealpha($transparent, 255, 255, 255, 127);
                    imagesetpixel($transparent, $x, $y, $whiteTransparent);
                }
            }
        }

        imagepng($transparent, $imagePath);

        imagedestroy($image);
        imagedestroy($transparent);
    }
}
