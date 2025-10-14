<?php

namespace App\Http\Controllers\Legalizer;

use App\Models\Arsip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $bidang = Auth::user()->bidang->nama_bidang;
        $bidangId = Auth::user()->bidang_id;
        $jumlahArsip = Arsip::with('user.bidang')->whereHas('user', function ($query) use ($bidangId) {
            $query->where('bidang_id', $bidangId);
        })->count();
        $belumLegal = Arsip::with('user.bidang')->whereHas('user', function ($query) use ($bidangId) {
            $query->where('bidang_id', $bidangId);
            $query->where('status_legalisasi', 'onProgress');
        })->count();


        $data = [
            'active' => 'dashboard',
            'open' => '',
            'link' => "Dashboard Legalizer $bidang",
            'jumlahArsip' => $jumlahArsip,
            'jumlahArsipBelumLegal' => $belumLegal
        ];

        return view('legalizer.dashboard', $data);
    }
}
