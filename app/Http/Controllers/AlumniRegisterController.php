<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\TahunLulus;
use App\Models\KonsentrasiKeahlian;
use App\Models\StatusAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AlumniRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $tahunLulus = TahunLulus::all();
        $konsentrasiKeahlian = KonsentrasiKeahlian::with('programKeahlian.bidangKeahlian')->get();
        $statusAlumni = StatusAlumni::all();
        
        return view('users.alumni-register', compact('tahunLulus', 'konsentrasiKeahlian', 'statusAlumni'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'id_tahun_lulus' => 'required|exists:tbl_tahun_lulus,id_tahun_lulus',
            'id_konsentrasi_keahlian' => 'required|exists:tbl_konsentrasi_keahlian,id_konsentrasi_keahlian',
            'id_status_alumni' => 'required|exists:tbl_status_alumni,id_status_alumni',
            'nisn' => 'nullable|string|max:20',
            'nik' => 'nullable|string|max:20',
            'nama_depan' => 'required|string|max:50',
            'nama_belakang' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:20',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string|max:50',
            'no_hp' => 'nullable|string|max:15',
            'akun_fb' => 'nullable|string|max:50',
            'akun_ig' => 'nullable|string|max:50',
            'akun_tiktok' => 'nullable|string|max:50',
            'email' => 'required|string|email|max:50|unique:tbl_alumni,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $alumni = Alumni::create([
            'id_tahun_lulus' => $request->id_tahun_lulus,
            'id_konsentrasi_keahlian' => $request->id_konsentrasi_keahlian,
            'id_status_alumni' => $request->id_status_alumni,
            'nisn' => $request->nisn,
            'nik' => $request->nik,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'akun_fb' => $request->akun_fb,
            'akun_ig' => $request->akun_ig,
            'akun_tiktok' => $request->akun_tiktok,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_login' => '0'
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('home')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}