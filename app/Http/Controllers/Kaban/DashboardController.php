<?php

namespace App\Http\Controllers\Kaban;

use App\Models\Arsip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $bidang = Auth::user()->bidang->nama_bidang;
        $jumlahArsip = Arsip::get()->count();
        $belumLegal = Arsip::where('status_legalisasi', 'onProgress')->get()->count();

        $data = [
            'active' => 'dashboard',
            'open' => '',
            'link' => "Dashboard $bidang",
            'jumlahArsip' => $jumlahArsip,
            'jumlahArsipBelumLegal' => $belumLegal
        ];

        return view('kaban.dashboard', $data);
    }
}
