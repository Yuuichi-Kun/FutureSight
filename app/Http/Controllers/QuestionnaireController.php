<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TracerKerja;
use App\Models\TracerKuliah;
use App\Models\Testimoni;
use Carbon\Carbon;

class QuestionnaireController extends Controller
{
    /**
     * Display the questionnaire form
     */
    public function index()
    {
        // Cek apakah user sudah memiliki data alumni
        if (!auth()->user()->alumni) {
            return redirect()->route('alumni.register')
                ->with('error', 'Anda harus melengkapi data alumni terlebih dahulu.');
        }

        // Cek status approval user
        if (auth()->user()->status !== 'approved') {
            return redirect()->route('home')
                ->with('error', 'Akun Anda masih menunggu persetujuan admin. Silakan tunggu hingga akun Anda disetujui.');
        }

        // Ambil data tracer yang sudah ada (jika ada)
        $tracerKerja = TracerKerja::where('id_alumni', auth()->user()->alumni->id_alumni)->first();
        $tracerKuliah = TracerKuliah::where('id_alumni', auth()->user()->alumni->id_alumni)->first();
        $testimoni = Testimoni::where('id_alumni', auth()->user()->alumni->id_alumni)->first();

        return view('questionnaire.index', compact('tracerKerja', 'tracerKuliah', 'testimoni'));
    }

    /**
     * Store tracer kerja data
     */
    public function storeTracerKerja(Request $request)
    {
        // Validasi keberadaan data alumni dan status approval
        if (!auth()->user()->alumni || auth()->user()->status !== 'approved') {
            return redirect()->route('home')
                ->with('error', 'Anda tidak memiliki akses ke fitur ini.');
        }

        try {
            // Validasi input
            $validated = $request->validate([
                'tracer_kerja_pekerjaan' => 'required|string|max:255',
                'tracer_kerja_nama' => 'required|string|max:255',
                'jenis_perusahaan' => 'required|string|in:BUMN,Swasta,Wiraswasta',
                'bentuk_lembaga' => 'required|string|in:PT,CV,Firma,Perseorangan',
                'tracer_kerja_jabatan' => 'required|string|max:255',
                'tracer_kerja_status' => 'required|string|in:Tetap,Kontrak,Freelance',
                'tracer_kerja_lokasi' => 'required|string|max:255',
                'tracer_kerja_alamat' => 'required|string|max:255',
                'tracer_kerja_tgl_mulai' => 'required|date',
                'tracer_kerja_gaji' => 'required|string|in:< 1 juta,1-3 juta,3-5 juta,> 5 juta',
            ]);

            // Tambahkan id_alumni ke data yang akan disimpan
            $validated['id_alumni'] = auth()->user()->alumni->id_alumni;
            
            // Tambahkan timestamps jika belum ada
            $validated['created_at'] = now();
            $validated['updated_at'] = now();

            // Cek apakah data sudah ada
            $existingData = TracerKerja::where('id_alumni', $validated['id_alumni'])->first();

            if ($existingData) {
                // Update data yang sudah ada
                $existingData->update($validated);
                $message = 'Data pekerjaan berhasil diperbarui!';
            } else {
                // Buat data baru
                TracerKerja::create($validated);
                $message = 'Data pekerjaan berhasil disimpan!';
            }

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error saving tracer kerja: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data pekerjaan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Store tracer kuliah data
     */
    public function storeTracerKuliah(Request $request)
    {
        // Validasi keberadaan data alumni dan status approval
        if (!auth()->user()->alumni || auth()->user()->status !== 'approved') {
            return redirect()->route('home')
                ->with('error', 'Anda tidak memiliki akses ke fitur ini.');
        }

        // Validasi input
        $validated = $request->validate([
            'tracer_kuliah_kampus' => 'required|string',
            'tracer_kuliah_status' => 'required|in:Negeri,Swasta',
            'tracer_kuliah_jenjang' => 'required|in:D3,D4,S1,S2,S3',
            'tracer_kuliah_jurusan' => 'required|string',
            'tracer_kuliah_linier' => 'required|in:Ya,Tidak',
            'tracer_kuliah_alamat' => 'required|string',
        ]);

        try {
            // Tambahkan id_alumni ke data yang akan disimpan
            $validated['id_alumni'] = auth()->user()->alumni->id_alumni;

            // Cek apakah data sudah ada
            $existingData = TracerKuliah::where('id_alumni', $validated['id_alumni'])->first();

            if ($existingData) {
                // Update data yang sudah ada
                $existingData->update($validated);
                $message = 'Data kuliah berhasil diperbarui!';
            } else {
                // Buat data baru
                TracerKuliah::create($validated);
                $message = 'Data kuliah berhasil disimpan!';
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data kuliah.')
                ->withInput();
        }
    }

    /**
     * Store testimoni data
     */
    public function storeTestimoni(Request $request)
    {
        // Validasi keberadaan data alumni dan status approval
        if (!auth()->user()->alumni || auth()->user()->status !== 'approved') {
            return redirect()->route('home')
                ->with('error', 'Anda tidak memiliki akses ke fitur ini.');
        }

        // Validasi input
        $validated = $request->validate([
            'testimoni' => 'required|string|min:10',
        ]);

        try {
            // Tambahkan id_alumni dan tanggal ke data yang akan disimpan
            $validated['id_alumni'] = auth()->user()->alumni->id_alumni;
            $validated['tgl_testimoni'] = Carbon::now();

            // Cek apakah data sudah ada
            $existingData = Testimoni::where('id_alumni', $validated['id_alumni'])->first();

            if ($existingData) {
                // Update data yang sudah ada
                $existingData->update($validated);
                $message = 'Testimoni berhasil diperbarui!';
            } else {
                // Buat data baru
                Testimoni::create($validated);
                $message = 'Testimoni berhasil disimpan!';
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan testimoni.')
                ->withInput();
        }
    }
}
