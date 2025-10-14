<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Bidang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Psy\Exception\Exception;
use App\Mail\UserActivationMail;
use Illuminate\Support\Facades\DB;
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
            'role' => 'required|in:operator,admin,legalizer,sekban',
            'jabatan' => 'required|string',
            'nip' => 'required|string|unique:users,nip'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credential = $validator->validate();

        try {
            DB::transaction(function () use ($credential) {
                $verificationToken = Str::random(64);

                $user = User::create([
                    'bidang_id' => e($credential['bidang']),
                    'name' => e($credential['nama']),
                    'email' => e($credential['email']),
                    'role' => e($credential['role']),
                    'password' => Hash::make('12345678'),
                    'status' => 'nonActive',
                    'verification_token' => $verificationToken,
                    'jabatan' => $credential['jabatan'],
                    'nip' => $credential['nip']
                ]);
                Mail::to($user->email)->send(new UserActivationMail($user));
            });

            return redirect()
                ->route('admin.user.index')
                ->with('success', 'User berhasil ditambahkan! Email aktivasi telah dikirim ke ' . $credential['email']);
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
        $userWithBidang = User::with('bidang')->where('id', '=', $user->id)->firstOrFail();
        $data = [
            'user' => $userWithBidang,
            'bidangs' => Bidang::all(),
            'active' => 'user',
            'open' => 'user',
            'link' => 'Edit user',
        ];
        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'bidang' => 'required|exists:bidangs,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nip' => 'required|unique:users,nip,' . $user->id,
            'jabatan' => 'required|string',
            'role' => 'required|in:operator,admin,legalizer,sekban',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $credential = $validator->validated();

        try {
            DB::transaction(function () use ($credential, $user) {
                if ($user->email !== $credential['email']) {
                    $verificationToken = Str::random(64);

                    $user->update([
                        'bidang_id' => e($credential['bidang']),
                        'name' => e($credential['nama']),
                        'email' => e($credential['email']),
                        'role' => e($credential['role']),
                        'status' => 'nonActive',
                        'jabatan' => $credential['jabatan'],
                        'verification_token' => $verificationToken,
                        'nip' => $credential['nip']
                    ]);
                } else {
                    $user->update([
                        'bidang_id' => $credential['bidang'],
                        'name' => $credential['nama'],
                        'email' => $credential['email'],
                        'role' => $credential['role'],
                        'jabatan' => $credential['jabatan'],
                        'nip' => $credential['nip']
                    ]);
                }
            });

            if ($user->wasChanged('email')) {
                Mail::to($user->email)->send(new UserActivationMail($user));
            }

            return redirect()->route('admin.user.index')->with('success', 'Data user berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Data User gagal diperbarui'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function setStatus(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:active,nonActive'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $credential = $validator->validate();

        try {
            $user->update([
                'status' => e($credential['status'])
            ]);
            if ($credential['status'] == 'active') {
                $pesan = 'Aktifkan';
            } else {
                $pesan = 'Non Aktifkan';
            }

            return redirect()->back()->with('success', "Akun $user->name di $pesan!");
        } catch (Exception $e) {
            if ($credential['status'] == 'active') {
                $pesan = 'Aktifkan';
            } else {
                $pesan = 'Non Aktifkan';
            }
            return redirect()->back()->withErrors(['errors' => "Akun $user->name gagal di $pesan"]);
        }
    }
}
