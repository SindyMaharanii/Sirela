<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lembaga;

class AdminController extends Controller
{
    public function detailLembaga($id)
    {
        // Ambil data user (lembaga) lengkap
        $user = User::findOrFail($id);
        
        // Ambil data profil lembaga jika ada
        $lembaga = Lembaga::with('kategori')->where('pengguna_id', $id)->first();
        
        return view('admin.detail-lembaga', compact('user', 'lembaga'));
    }
}