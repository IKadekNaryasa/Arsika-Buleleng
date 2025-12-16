<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Arsip;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Storage;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class HomeController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('ARSIKA Buleleng')
            ->setTitleDefault('')
            ->setDescription('Sistem informasi yang dirancang untuk mengelola dan menyimpan data Arsip Kesbangpol Buleleng secara digital dan terstruktur. Dilengkapi dengan fitur sinkronisasi Google Drive.')
            ->addKeyword(['ARSIKA Buleleng', 'Arsip Digital', 'Kesbangpol Buleleng', 'Sistem Informasi Arsip'])
            ->setCanonical(url('/'))
            ->addMeta('author', 'Prakom Kesbangpol Buleleng')
            ->addMeta('robots', 'index, follow');

        OpenGraph::setTitle('ARSIKA Buleleng - Arsip Digital Kesbangpol Buleleng')
            ->setDescription('Sistem informasi yang dirancang untuk mengelola dan menyimpan data Arsip Kesbangpol Buleleng secara digital dan terstruktur.')
            ->setType('website')
            ->setUrl(url('/'))
            ->addProperty('locale', 'id_ID')
            ->addImage(asset('img/arsika.png'));

        JsonLd::setType('GovernmentOrganization');
        JsonLd::addValue('name', 'ARSIKA Buleleng');
        JsonLd::addValue('alternateName', 'Arsip Digital Kesbangpol Buleleng');
        JsonLd::addValue('url', url('/'));
        JsonLd::addValue('logo', asset('img/arsika.png'));
        JsonLd::addValue('description', 'Sistem informasi untuk mengelola dan menyimpan data Arsip Kesbangpol Buleleng secara digital.');
        JsonLd::addValue('address', [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Singaraja',
            'addressRegion' => 'Buleleng, Bali',
            'addressCountry' => 'ID'
        ]);

        return view('arsika');
    }

    public function cekLegalisasi($id)
    {
        try {
            $arsip = Arsip::with('user.bidang', 'kodeKlasifikasi')->findOrFail($id);

            $data = [
                'active' => '',
                'open' => '',
                'link' => 'Validasi Arsip',
                'arsip' => $arsip,
                'valid' => true
            ];

            return view('cekLegalisasi', $data);
        } catch (\Exception $e) {
            $data = [
                'active' => '',
                'open' => '',
                'link' => 'Validasi Arsip',
                'arsip' => null,
                'valid' => false
            ];

            return view('cekLegalisasi', $data);
        }
    }

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
}
