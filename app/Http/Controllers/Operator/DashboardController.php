<?php

namespace App\Http\Controllers\Operator;

use App\Models\Arsip;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $bidang = Auth::user()->bidang->nama_bidang;
        $bidangId = Auth::user()->bidang_id;
        $jumlahArsipBidang = Arsip::with('user.bidang')->whereHas('user', function ($query) use ($bidangId) {
            $query->where('bidang_id', $bidangId);
        })->count();


        $data = [
            'active' => 'dashboard',
            'open' => '',
            'link' => "Dashboard $bidang",
            'jumlahArsipBidang' => $jumlahArsipBidang
        ];
        return view('operator.dashboard', $data);
    }
}
