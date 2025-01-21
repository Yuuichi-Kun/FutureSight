@extends('layouts.user')

@section('title', 'Kuesioner Alumni')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-primary">Kuesioner Alumni</h2>
                <p class="text-muted">Silakan lengkapi data di bawah ini dengan informasi yang akurat</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Data Pekerjaan -->
            <div class="card shadow-sm mb-4 border-0 rounded-3">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i>Data Pekerjaan</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('questionnaire.store.kerja') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="pekerjaan" name="tracer_kerja_pekerjaan" placeholder="Pekerjaan" required>
                                    <label for="pekerjaan">Pekerjaan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="perusahaan" name="tracer_kerja_nama" placeholder="Nama Perusahaan" required>
                                    <label for="perusahaan">Nama Perusahaan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="jenisPerusahaan" name="jenis_perusahaan" required>
                                        <option value="BUMN">BUMN</option>
                                        <option value="Swasta">Swasta</option>
                                        <option value="Wiraswasta">Wiraswasta</option>
                                    </select>
                                    <label for="jenisPerusahaan">Jenis Perusahaan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="bentukLembaga" name="bentuk_lembaga" required>
                                        <option value="PT">PT (Perseroan Terbatas)</option>
                                        <option value="CV">CV (Commanditaire Vennootschap)</option>
                                        <option value="Firma">Firma</option>
                                        <option value="Perseorangan">Perseorangan</option>
                                    </select>
                                    <label for="bentukLembaga">Bentuk Lembaga</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="jabatan" name="tracer_kerja_jabatan" placeholder="Jabatan" required>
                                    <label for="jabatan">Jabatan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="status" name="tracer_kerja_status" required>
                                        <option value="Tetap">Tetap</option>
                                        <option value="Kontrak">Kontrak</option>
                                        <option value="Freelance">Freelance</option>
                                    </select>
                                    <label for="status">Status</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="lokasi" name="tracer_kerja_lokasi" placeholder="Lokasi" required>
                                    <label for="lokasi">Lokasi</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="alamat" name="tracer_kerja_alamat" placeholder="Alamat" required>
                                    <label for="alamat">Alamat</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="tanggalMulai" name="tracer_kerja_tgl_mulai" required>
                                    <label for="tanggalMulai">Tanggal Mulai</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select" id="gaji" name="tracer_kerja_gaji" required>
                                        <option value="< 1 juta">< 1 juta</option>
                                        <option value="1-3 juta">1-3 juta</option>
                                        <option value="3-5 juta">3-5 juta</option>
                                        <option value="> 5 juta">> 5 juta</option>
                                    </select>
                                    <label for="gaji">Gaji</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Simpan Data Pekerjaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Data Kuliah -->
            <div class="card shadow-sm mb-4 border-0 rounded-3">
                <div class="card-header bg-success text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Data Kuliah</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('questionnaire.store.kuliah') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="kampus" name="tracer_kuliah_kampus" placeholder="Nama Kampus" required>
                                    <label for="kampus">Nama Kampus</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="statusKampus" name="tracer_kuliah_status" required>
                                        <option value="Negeri">Negeri</option>
                                        <option value="Swasta">Swasta</option>
                                    </select>
                                    <label for="statusKampus">Status</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="jenjang" name="tracer_kuliah_jenjang" required>
                                        <option value="D3">D3</option>
                                        <option value="D4">D4</option>
                                        <option value="S1">S1</option>
                                    </select>
                                    <label for="jenjang">Jenjang</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="jurusan" name="tracer_kuliah_jurusan" placeholder="Jurusan" required>
                                    <label for="jurusan">Jurusan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="linear" name="tracer_kuliah_linier" required>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                    <label for="linear">Linear dengan SMK?</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="alamatKampus" name="tracer_kuliah_alamat" placeholder="Alamat Kampus" required>
                                    <label for="alamatKampus">Alamat Kampus</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save me-2"></i>Simpan Data Kuliah
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Testimoni -->
            <div class="card shadow-sm mb-4 border-0 rounded-3">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-comment-alt me-2"></i>Testimoni</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('questionnaire.store.testimoni') }}" method="POST">
                        @csrf
                        <div class="form-floating">
                            <textarea class="form-control" id="testimoni" name="testimoni" style="height: 150px" placeholder="Minimal 10 karakter" required></textarea>
                            <label for="testimoni">Testimoni Anda</label>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-info text-white px-4">
                                <i class="fas fa-save me-2"></i>Simpan Testimoni
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-floating > .form-control,
.form-floating > .form-select {
    height: calc(3.5rem + 2px);
    line-height: 1.25;
}

.form-floating > label {
    padding: 1rem 0.75rem;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.btn {
    padding: 0.5rem 1.5rem;
    font-weight: 500;
}

.alert {
    border-left: 4px solid;
}

.alert-success {
    border-left-color: #198754;
}

.alert-danger {
    border-left-color: #dc3545;
}
</style>

<!-- Tambahkan Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection