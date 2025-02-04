@extends('layouts.user')

@section('content')
<div class="container py-4 py-lg-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow border-0 rounded-3 overflow-hidden">
                <!-- Header Card -->
                <div class="card-header bg-gradient-primary p-4">
                    <h4 class="mb-0 text-center text-white">
                        <i class="fas fa-user-graduate me-2"></i>{{ __('Registrasi Alumni') }}
                    </h4>
                    <p class="text-center text-white-50 small mb-0 mt-2">
                        Silakan lengkapi data diri Anda dengan benar
                    </p>
                </div>

                <div class="card-body p-3 p-lg-4">
                    <form method="POST" action="{{ route('alumni.register') }}" class="needs-validation" novalidate>
                        @csrf
                        
                        <!-- Data Akademik Section -->
                        <div class="section-card mb-4">
                            <div class="section-header d-flex align-items-center mb-3">
                                <i class="fas fa-graduation-cap text-primary me-2"></i>
                                <h5 class="mb-0 text-primary">Data Akademik</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
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
                                
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
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
                                    <label class="form-label">Status Alumni (Pilih satu atau lebih)</label>
                                    <div class="status-group p-3 border rounded bg-light">
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($statusAlumni as $status)
                                                <div class="status-option flex-grow-1">
                                                    <input type="checkbox" 
                                                        class="btn-check" 
                                                        name="id_status_alumni[]" 
                                                        id="status_{{ $status->id_status_alumni }}" 
                                                        value="{{ $status->id_status_alumni }}"
                                                        {{ in_array($status->id_status_alumni, old('id_status_alumni', [])) ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-primary w-100" for="status_{{ $status->id_status_alumni }}">
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
                        <div class="section-card mb-4">
                            <div class="section-header d-flex align-items-center mb-3">
                                <i class="fas fa-user text-primary me-2"></i>
                                <h5 class="mb-0 text-primary">Data Pribadi</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" 
                                               name="nisn" value="{{ old('nisn') }}" placeholder="NISN"
                                               pattern="[0-9]*" inputmode="numeric" maxlength="10"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                               <br>
                                        @error('nisn')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror" 
                                               name="nik" value="{{ old('nik') }}" placeholder="NIK"
                                               pattern="[0-9]*" inputmode="numeric" maxlength="16"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nama_depan') is-invalid @enderror" 
                                               name="nama_depan" value="{{ old('nama_depan') }}" required placeholder="Nama Depan">
                                               <br>
                                        @error('nama_depan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nama_belakang') is-invalid @enderror" 
                                               name="nama_belakang" value="{{ old('nama_belakang') }}" required placeholder="Nama Belakang">
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
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                               name="tempat_lahir" value="{{ old('tempat_lahir') }}" required placeholder="Tempat Lahir">
                                               <br>
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" 
                                               name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                                               <br>
                                        @error('tgl_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                                  name="alamat" required placeholder="Alamat" style="height: 100px">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kontak & Social Media Section -->
                        <div class="section-card mb-4">
                            <div class="section-header d-flex align-items-center mb-3">
                                <i class="fas fa-address-book text-primary me-2"></i>
                                <h5 class="mb-0 text-primary">Kontak & Social Media</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                               name="no_hp" value="{{ old('no_hp') }}" id="no_hp" placeholder="No. HP"
                                               pattern="[0-9]*" inputmode="numeric" maxlength="15"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        <label for="no_hp">No. HP</label>
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               name="email" value="{{ old('email') }}" id="email" required placeholder="Email">
                                        <label for="email">Email</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('akun_fb') is-invalid @enderror" 
                                               name="akun_fb" value="{{ old('akun_fb') }}" id="akun_fb" placeholder="Facebook">
                                        <label for="akun_fb">Facebook</label>
                                        @error('akun_fb')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('akun_ig') is-invalid @enderror" 
                                               name="akun_ig" value="{{ old('akun_ig') }}" id="akun_ig" placeholder="Instagram">
                                        <label for="akun_ig">Instagram</label>
                                        @error('akun_ig')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('akun_tiktok') is-invalid @enderror" 
                                               name="akun_tiktok" value="{{ old('akun_tiktok') }}" id="akun_tiktok" placeholder="TikTok">
                                        <label for="akun_tiktok">TikTok</label>
                                        @error('akun_tiktok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="section-card mb-4">
                            <div class="section-header d-flex align-items-center mb-3">
                                <i class="fas fa-lock text-primary me-2"></i>
                                <h5 class="mb-0 text-primary">Password</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                               name="password" required placeholder="Password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" 
                                               name="password_confirmation" required placeholder="Konfirmasi Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end d-flex justify-content-end gap-3">
                            <a href="{{ route('home') }}" class="btn btn-secondary btn-lg px-4 px-lg-5" style="margin-right: 10px;">
                                <i class="fas fa-times me-2"></i>{{ __('Cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-4 px-lg-5" id="registerButton">
                                <i class="fas fa-user-plus me-2"></i><span class="button-text">{{ __('Register') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.button-spinner {
    display: none;
    width: 1rem;
    height: 1rem;
    border: 0.2em solid currentColor;
    border-right-color: transparent;
    border-radius: 50%;
    animation: button-spinner 0.75s linear infinite;
}

@keyframes button-spinner {
    to {
        transform: rotate(360deg);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form.needs-validation');
    const submitButton = document.getElementById('registerButton');
    const buttonText = submitButton.querySelector('.button-text');
    const originalText = buttonText.textContent;

    // Create spinner element
    const spinner = document.createElement('span');
    spinner.className = 'button-spinner';
    
    form.addEventListener('submit', function(e) {
        // Prevent multiple submissions
        if (submitButton.disabled) {
            e.preventDefault();
            return;
        }

        // Disable button and show loading state
        submitButton.disabled = true;
        buttonText.textContent = 'Processing...';
        submitButton.insertBefore(spinner, buttonText);
        spinner.style.display = 'inline-block';
        
        // Enable button after 10 seconds (failsafe)
        setTimeout(function() {
            submitButton.disabled = false;
            buttonText.textContent = originalText;
            spinner.style.display = 'none';
        }, 10000);
    });
});
</script>

@endsection