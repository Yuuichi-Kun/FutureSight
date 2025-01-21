<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Alumni;
use App\Models\TracerKerja;
use App\Models\TracerKuliah;
use App\Models\Testimoni;

class AdminController extends Controller
{
    public function dashboardAdmin()
    {
        // Hitung statistik untuk dashboard
        $totalAlumni = Alumni::count();
        $totalBekerja = TracerKerja::count();
        $totalKuliah = TracerKuliah::count();
        $responseRate = ($totalAlumni > 0) ? 
            round((($totalBekerja + $totalKuliah) / $totalAlumni) * 100) : 0;

        // Tambahkan data untuk komponen baru
        $latestTestimonials = Testimoni::with('alumni')
            ->latest('tgl_testimoni')
            ->take(5)
            ->get();

        $latestAlumni = Alumni::with(['statusAlumni', 'tahunLulus'])
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('admin.adminHome', compact(
            'totalAlumni',
            'totalBekerja',
            'totalKuliah',
            'responseRate',
            'latestTestimonials',
            'latestAlumni'
        ));
    }

    public function profileAdmin(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function alumniIndex()
    {
        $alumni = Alumni::with(['tahunLulus', 'konsentrasiKeahlian', 'statusAlumni'])
            ->orderBy('nama_depan')
            ->paginate(10);
        
        return view('admin.alumni.index', compact('alumni'));
    }

    public function alumniShow(Alumni $alumni)
    {
        // Pengecekan apakah alumni memiliki relasi user
        if (!$alumni->user) {
            return redirect()->route('admin.alumni.index')
                ->with('error', 'Data user alumni tidak ditemukan.');
        }

        $alumni->load([
            'user',  // Tambahkan eager loading untuk user
            'tracerKerja',
            'tracerKuliah',
            'testimoni',
            'tahunLulus',
            'konsentrasiKeahlian',
            'statusAlumni'
        ]);
        
        return view('admin.alumni.show', compact('alumni'));
    }
}


