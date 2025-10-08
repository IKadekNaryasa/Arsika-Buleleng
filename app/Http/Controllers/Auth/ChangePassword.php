<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePassword extends Controller
{
    public function changePassword(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required|string|min:8',
            'newPassword' => 'required|string|min:8',
            'confirmNewPassword' => 'required|string|same:newPassword|min:8'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $credential = $validator->validate();
        $newPassword = e($credential['newPassword']);
        try {
            if (!Hash::check($credential['oldPassword'], $user->password)) {
                return redirect()->back()->withErrors(['errors' => 'Password lama tidak sesuai!']);
            }
            DB::transaction(function () use ($user, $newPassword) {
                $user->update([
                    'password' => Hash::make($newPassword),
                ]);
            });

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('success', 'Password Updated, Login again!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Failed to update pasword!']);
        }
    }
}
