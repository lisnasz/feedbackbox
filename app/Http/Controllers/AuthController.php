<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Services\ActivityLogService;
use App\Models\User;

class AuthController extends Controller
{
    // Admin credentials (fallback for hardcoded login)
    const ADMIN_USERNAME = 'admin';
    const ADMIN_PASSWORD_HASH = '$2y$12$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86.FOULCnxi'; // bcrypt('admin123')

    // Rate limiting constants
    const MAX_LOGIN_ATTEMPTS = 5;
    const RATE_LIMIT_MINUTES = 15;

    public function showLogin()
    {
        if (Session::has('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        // Check rate limiting
        $failedAttempts = ActivityLogService::getLoginAttempts(
            $request->ip(),
            self::RATE_LIMIT_MINUTES
        );

        if ($failedAttempts >= self::MAX_LOGIN_ATTEMPTS) {
            ActivityLogService::log(
                $request->username,
                'login',
                'Rate limit exceeded',
                'failed',
                $request
            );
            return back()
                ->withErrors(['message' => 'Terlalu banyak percobaan login gagal. Coba lagi dalam 15 menit.'])
                ->withInput();
        }

        // Try to authenticate from database first
        $user = User::where('email', $request->username)
                    ->orWhere('name', $request->username)
                    ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('admin', true);
            Session::put('admin_user_id', $user->id);
            Session::put('admin_username', $user->email);
            Session::put('admin_name', $user->name);
            
            ActivityLogService::log(
                $user->name,
                'login',
                'Login successful from database',
                'success',
                $request
            );
            
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil');
        }

        // Fallback to hardcoded credentials
        if ($request->username === self::ADMIN_USERNAME && 
            Hash::check($request->password, self::ADMIN_PASSWORD_HASH)) {
            
            Session::put('admin', true);
            Session::put('admin_username', $request->username);
            
            ActivityLogService::log(
                $request->username,
                'login',
                'Login successful (hardcoded)',
                'success',
                $request
            );
            
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil');
        }

        // Log failed attempt
        ActivityLogService::log(
            $request->username,
            'login',
            'Invalid credentials',
            'failed',
            $request
        );

        return back()
            ->withErrors(['message' => 'Username atau password salah'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        $username = session('admin_username', 'unknown');
        
        ActivityLogService::log(
            $username,
            'logout',
            'Logout successful',
            'success',
            $request
        );
        
        Session::forget('admin');
        Session::forget('admin_user_id');
        Session::forget('admin_username');
        Session::forget('admin_name');
        return redirect()->route('admin.login')->with('success', 'Logout berhasil');
    }
}
