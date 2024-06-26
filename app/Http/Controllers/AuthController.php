<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // fungsi untuk menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // fungsi untuk menjalankan login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // Cek role
            $user = Auth::user();
            if ($user->is_admin == true) {
                return redirect()->intended('dashboard')->with('success', 'Login Berhasil!');
            } else {
                return redirect()->intended('home')->with('success', 'Login Berhasil!');
            }
        }
        // Validasi email
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // fungsi untuk menampilkan form daftar atau register
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // fungsi untuk menjalankan register
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'photo' => ['nullable', 'image', 'max:5120'], // Max 5MB
        ]);

        // Cek foto
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }
        $data['photo'] = $request->file('photo') ?? 'user/user.png';

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        Auth::login($user);

        return redirect()->route('login')->with('success', 'Daftar Berhasil!');
    }

    // fungsi untuk keluar atau logout akun
    public function logout()
    {
        Auth::logout();
        return redirect('home')->with(['success' =>'Logout Berhasil']);
    }
}
