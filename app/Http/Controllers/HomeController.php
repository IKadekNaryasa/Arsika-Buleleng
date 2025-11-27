<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

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
}
