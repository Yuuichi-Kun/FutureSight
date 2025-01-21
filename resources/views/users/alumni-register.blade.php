@extends('layouts.user')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-gradient-primary text-white p-4">
                    <h4 class="mb-0 text-center">
                        <i class="fas fa-user-graduate me-2"></i>{{ __('Registrasi Alumni') }}
                    </h4>
                    <p class="text-center text-white-50 small mb-0 mt-2">Silakan lengkapi data diri Anda dengan benar</p>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('alumni.register') }}" class="needs-validation" novalidate>
                        @csrf
                        
                        <!-- Data Akademik Section -->
                        <div class="section-divider mb-4">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-graduation-cap me-2"></i>Data Akademik
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="id_tahun_lulus" class="form-select @error('id_tahun_lulus') is-invalid @enderror">
                                            <option value="">Pilih Tahun Lulus</option>
                                            @foreach($tahunLulus as $tahun)
                                                <option value="{{ $tahun->id_tahun_lulus }}" {{ old('id_tahun_lulus') == $tahun->id_tahun_lulus ? 'selected' : '' }}>
                                                    {{ $tahun->tahun_lulus }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label>Tahun Lulus</label>
                                        @error('id_tahun_lulus')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="id_konsentrasi_keahlian" class="form-select @error('id_konsentrasi_keahlian') is-invalid @enderror">
                                            <option value="">Pilih Konsentrasi Keahlian</option>
                                            @foreach($konsentrasiKeahlian as $konsentrasi)
                                                <option value="{{ $konsentrasi->id_konsentrasi_keahlian }}" {{ old('id_konsentrasi_keahlian') == $konsentrasi->id_konsentrasi_keahlian ? 'selected' : '' }}>
                                                    {{ $konsentrasi->konsentrasi_keahlian }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label>Konsentrasi Keahlian</label>
                                        @error('id_konsentrasi_keahlian')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Status Alumni</label>
                                    <div class="status-group p-3 border rounded">
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($statusAlumni as $status)
                                                <div class="status-option">
                                                    <input type="radio" 
                                                        class="btn-check" 
                                                        name="id_status_alumni" 
                                                        id="status_{{ $status->id_status_alumni }}" 
                                                        value="{{ $status->id_status_alumni }}"
                                                        {{ old('id_status_alumni') == $status->id_status_alumni ? 'checked' : '' }}
                                                        required>
                                                    <label class="btn btn-outline-primary" for="status_{{ $status->id_status_alumni }}">
                                                        {{ $status->status_alumni }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('id_status_alumni')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Pribadi Section -->
                        <div class="section-divider mb-4">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-user me-2"></i>Data Pribadi
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" 
                                               name="nisn" value="{{ old('nisn') }}" placeholder="NISN">
                                        <label>NISN</label>
                                        @error('nisn')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror" 
                                               name="nik" value="{{ old('nik') }}" placeholder="NIK">
                                        <label>NIK</label>
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nama_depan') is-invalid @enderror" 
                                               name="nama_depan" value="{{ old('nama_depan') }}" required placeholder="Nama Depan">
                                        <label>Nama Depan</label>
                                        @error('nama_depan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nama_belakang') is-invalid @enderror" 
                                               name="nama_belakang" value="{{ old('nama_belakang') }}" required placeholder="Nama Belakang">
                                        <label>Nama Belakang</label>
                                        @error('nama_belakang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        <label>Jenis Kelamin</label>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                               name="tempat_lahir" value="{{ old('tempat_lahir') }}" required placeholder="Tempat Lahir">
                                        <label>Tempat Lahir</label>
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" 
                                               name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                                        <label>Tanggal Lahir</label>
                                        @error('tgl_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                                  name="alamat" required placeholder="Alamat" style="height: 100px">{{ old('alamat') }}</textarea>
                                        <label>Alamat</label>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kontak & Social Media Section -->
                        <div class="section-divider mb-4">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-address-book me-2"></i>Kontak & Social Media
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                               name="no_hp" value="{{ old('no_hp') }}" placeholder="No. HP">
                                        <label>No. HP</label>
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               name="email" value="{{ old('email') }}" required placeholder="Email">
                                        <label>Email</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('akun_fb') is-invalid @enderror" 
                                               name="akun_fb" value="{{ old('akun_fb') }}" placeholder="Facebook">
                                        <label>Facebook</label>
                                        @error('akun_fb')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('akun_ig') is-invalid @enderror" 
                                               name="akun_ig" value="{{ old('akun_ig') }}" placeholder="Instagram">
                                        <label>Instagram</label>
                                        @error('akun_ig')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('akun_tiktok') is-invalid @enderror" 
                                               name="akun_tiktok" value="{{ old('akun_tiktok') }}" placeholder="TikTok">
                                        <label>TikTok</label>
                                        @error('akun_tiktok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="section-divider mb-4">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-lock me-2"></i>Password
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                               name="password" required placeholder="Password">
                                        <label>Password</label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" 
                                               name="password_confirmation" required placeholder="Konfirmasi Password">
                                        <label>Konfirmasi Password</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-user-plus me-2"></i>{{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df 0%, #224abe 100%);
}

.form-floating > .form-control,
.form-floating > .form-select {
    height: calc(3.5rem + 2px);
    line-height: 1.25;
}

.form-floating > textarea.form-control {
    height: 100px;
}

.form-floating > label {.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df 0%, #224abe 100%);
}

.form-floating > .form-control,
.form-floating > .form-select {
    height: calc(3.5rem + 2px);
    line-height: 1.25;
}

.form-floating > textarea.form-control {
    height: 100px;
}

.form-floating > label {
    padding: 1rem 0.75rem;
    color: #6c757d;
}

.section-divider {
    border-bottom: 1px solid #e3e6f0;
    padding-bottom: 1.5rem;
}

.section-divider:last-child {
    border-bottom: none;
}

.status-group {
    background-color: #f8f9fa;
}

.status-option label {
    min-width: 120px;
    text-align: center;
}

.btn-check:checked + .btn-outline-primary {
    background-color: #4e73df;
    border-color: #4e73df;
    color: white;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.form-control:focus,
.form-select:focus {
    border-color: #bac8f3;
    box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
}

.invalid-feedback {
    font-size: 80%;
    margin-top: 0.25rem;
}

@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem;
    }
    
    .btn-lg {
        padding: 0.5rem 1.5rem;
        font-size: 1rem;
    }
    
    .status-option label {
        min-width: 100px;
        font-size: 0.9rem;
    }
}
@endsection