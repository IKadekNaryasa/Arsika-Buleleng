<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Bidang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Psy\Exception\Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:operator,admin,kepala_badan',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credential = $validator->validate();

        try {
            $verificationToken = Str::random(64);

            $user = User::create([
                'bidang_id' => e($credential['bidang']),
                'name' => e($credential['nama']),
                'email' => e($credential['email']),
                'role' => e($credential['role']),
                'password' => Hash::make('12345678'),
                'status' => 'nonActive',
                'verification_token' => $verificationToken,
            ]);

            Mail::to($user->email)->send(new \App\Mail\UserActivationMail($user));

            return redirect()
                ->route('admin.user.index')
                ->with('success', 'User berhasil ditambahkan! Email aktivasi telah dikirim ke ' . $user->email);
        } catch (Exception $e) {
            Log::error('Error creating user ');
            return back()
                ->withErrors(['errors' => 'Gagal menambahkan User '])
                ->withInput();
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
