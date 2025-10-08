<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahUser = User::all()->count();
        $data = [
            'active' => 'dashboard',
            'open' => '',
            'link' => "Dashboard Admin",
            'cardJumlahUser' => $jumlahUser
        ];

        return view('admin.dashboard', $data);
    }
}
