<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    // fungsi untuk menampilkan edit profil
    public function edit()
    {
        return view('profile.edit');
    }

    // fungsi untuk menampilkan edit profil (admin)
    public function admin()
    {
        return view('profile.admin', [
            'active' => 'profile',
        ]);
    }

    // fungsi untuk menjalankan perubahan profil0
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi request
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Max 5MB
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:255',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        // Mengunggah dan menyimpan foto profil baru jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo && Storage::exists($user->photo)) {
                Storage::delete($user->photo);
            }

            // Simpan foto profil baru
            $photoPath = $request->file('photo')->store('photos', 'public');
            $user->photo = $photoPath;
        }

        // Update profil user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        
        // Periksa apakah password baru diinputkan
        if ($request->filled('new_password')) {
            // Validasi password lama
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'Password lama salah!');
            }

            // Update password
            $user->password = bcrypt($request->new_password);
        }
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}