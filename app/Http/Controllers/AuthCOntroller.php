<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('pages.logins');
    }
    public function login(Request $request)
    {
        // dd($request);

        $validateData = $request->validate([
            'email' => 'required',
            'password' => 'required|string',
        ]);

        // dd($validateData);

        if (Auth::attempt($validateData)) {
            $request->session()->regenerate(); // untuk keamanan sesi (session fixation)

            // $user = Auth::user();
            return response()->json([
                'success' => true,
                'user' => Auth::user()
            ]);
            // switch ($user->role) {
            //     case 'admin':
            //         return redirect()->intended('/admin/dashboard');
            //     case 'user':
            //         return redirect()->intended('/destinasi');
            //     default:
            //         return redirect()->intended('/');
            // }
            // return response()->json(['success' => true]);

            // return redirect()->intended('/dashboard'); // ubah sesuai rute tujuan
        }
        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah.'
        ], 401);

        // Jika login gagal
        // return back()->withErrors([
        //     'email' => 'Email atau password salah.',
        // ])->onlyInput('email');

    }
    public function viewRegister()
    {
        return view('pages.registers');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            // 'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // $user;
        // dd($user);
        return redirect()->route('logins')->with('success', 'Registrasi berhasil. Silakan login.');
    }


    public function logout(Request $request)
    {
        Auth::logout(); // 1. Proses logout user
        $request->session()->invalidate(); // 2. Hapus semua data session
        $request->session()->regenerateToken(); // 3. Buat token CSRF baru

        // Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
}
