<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Psy\Exception\Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('bidang')->get();
        $data = [
            'active' => 'dataUser',
            'link' => 'User',
            'open' => 'user',
            'users' => $users
        ];
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bidangs = Bidang::all();
        $data = [
            'active' => 'createUser',
            'open' => 'user',
            'link' => 'Create user',
            'bidangs' => $bidangs,
        ];
        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bidang' => 'required|exists:bidangs,id',
            'nama' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|in:operator,admin,kepala_badan',
            'status' => 'required|in:active,nonActive'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $credential = $validator->validate();
        try {
            User::create([
                'bidang_id' => e($credential['bidang']),
                'name' => e($credential['nama']),
                'email' => e($credential['email']),
                'role' => e($credential['role']),
                'password' => Hash::make('12345678'),
                'status' => e($credential['status']),
            ]);

            return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan!');
        } catch (Exception $e) {
            return back()->withErrors(['errors' => 'Gagal menambahkan User'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
