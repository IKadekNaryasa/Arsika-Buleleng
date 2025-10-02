<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserActivationController extends Controller
{
    public function activate($token)
    {
        try {
            $user = User::where('verification_token', $token)->first();

            if (!$user) {
                return view('auth.activation-result', [
                    'success' => false,
                    'message' => 'Token aktivasi tidak valid atau sudah kadaluarsa.'
                ]);
            }

            if ($user->email_verified_at !== null && $user->status === 'active') {
                return view('auth.activation-result', [
                    'success' => true,
                    'message' => 'Akun Anda sudah aktif sebelumnya. Silakan login.',
                    'already_activated' => true
                ]);
            }

            $user->update([
                'email_verified_at' => now(),
                'status' => 'active',
                'verification_token' => null,
            ]);

            return view('auth.activation-result', [
                'success' => true,
                'message' => 'Akun Anda berhasil diaktivasi!',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            Log::error('Error activating user: ' . $e->getMessage());

            return view('auth.activation-result', [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengaktivasi akun. Silakan hubungi administrator.'
            ]);
        }
    }
}
