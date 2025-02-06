@extends('layouts.user')

@section('content')
<div class="container py-4 py-lg-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="overflow-hidden border-0 shadow card rounded-3">
                <!-- Header Card -->
                <div class="p-4 card-header bg-gradient-primary">
                    <h4 class="mb-0 text-center text-white">
                        <i class="fas fa-user-graduate me-2"></i>{{ __('Registrasi Alumni') }}
                    </h4>
                    <p class="mt-2 mb-0 text-center text-white-50 small">
                        Silakan lengkapi data diri Anda dengan benar
                    </p>
                </div>

                <div class="p-3 card-body p-lg-4">
                    <form method="POST" action="{{ route('alumni.register') }}" class="needs-validation" novalidate>
                        @csrf

                        <!-- Data Akademik Section -->
                        <div class="mb-4 section-card">
                            <div class="mb-3 section-header d-flex align-items-center">
                                <i class="fas fa-graduation-cap text-primary me-2"></i>
                                <h5 class="mb-0 text-primary">Data Akademik</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label>Tahun Lulus</label>
                                    <div class="mb-3 form-floating">
                                        <select name="id_tahun_lulus"
                                            class="form-select @error('id_tahun_lulus') is-invalid @enderror">
                                            <option value="">Pilih Tahun Lulus</option>
                                            @foreach($tahunLulus as $tahun)
                                            <option value="{{ $tahun->id_tahun_lulus }}" {{
                                                old('id_tahun_lulus')==$tahun->id_tahun_lulus ? 'selected' : '' }}>
                                                {{ $tahun->tahun_lulus }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('id_tahun_lulus')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label>Konsentrasi Keahlian</label>
                                    <div class="mb-3 form-floating">
                                        <select name="id_konsentrasi_keahlian"
                                            class="form-select @error('id_konsentrasi_keahlian') is-invalid @enderror">
                                            <option value="">Pilih Konsentrasi Keahlian</option>
                                            @foreach($konsentrasiKeahlian as $konsentrasi)
                                            <option value="{{ $konsentrasi->id_konsentrasi_keahlian }}" {{
                                                old('id_konsentrasi_keahlian')==$konsentrasi->id_konsentrasi_keahlian ?
                                                'selected' : '' }}>
                                                {{ $konsentrasi->konsentrasi_keahlian }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('id_konsentrasi_keahlian')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Status Alumni (Pilih satu atau lebih)</label>
                                    <div class="p-3 border rounded status-group bg-light">
                                        <div class="flex-wrap gap-2 d-flex">
                                            @foreach($statusAlumni as $status)
                                            <div class="status-option flex-grow-1">
                                                <input type="checkbox" class="btn-check" name="id_status_alumni[]"
                                                    id="status_{{ $status->id_status_alumni }}"
                                                    value="{{ $status->id_status_alumni }}" {{
                                                    in_array($status->id_status_alumni, old('id_status_alumni', [])) ?
                                                'checked' : '' }}>
                                                <label class="btn btn-outline-primary w-100"
                                                    for="status_{{ $status->id_status_alumni }}">
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
                        <div class="mb-4 section-card">
                            <div class="mb-3 section-header d-flex align-items-center">
                                <i class="fas fa-user text-primary me-2"></i>
                                <h5 class="mb-0 text-primary">Data Pribadi</h5>
                            </div>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating" style="margin-bottom: 10px;">
                                        <label>NISN</label>
                                        <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                            name="nisn" value="{{ old('nisn') }}" placeholder="NISN" pattern="[0-9]*"
                                            inputmode="numeric" maxlength="10"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div>
                                    @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating" style="margin-bottom: 10px;">
                                        <label>NIK</label>
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                            name="nik" value="{{ old('nik') }}" placeholder="NIK" pattern="[0-9]*"
                                            inputmode="numeric" maxlength="16"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div>
                                    @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text"
                                            class="form-control @error('nama_depan') is-invalid @enderror"
                                            name="nama_depan" value="{{ old('nama_depan') }}" required
                                            placeholder="Nama Depan">
                                        <br>
                                        @error('nama_depan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6" style="margin-bottom: 10px;">
                                    <div class="form-floating">
                                        <input type="text"
                                            class="form-control @error('nama_belakang') is-invalid @enderror"
                                            name="nama_belakang" value="{{ old('nama_belakang') }}" required
                                            placeholder="Nama Belakang">
                                        @error('nama_belakang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6" style="margin-bottom: 10px;">
                                    <div class="form-floating">
                                        <select name="jenis_kelamin"
                                            class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki' ? 'selected'
                                                : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan' ? 'selected'
                                                : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            name="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                                            placeholder="Tempat Lahir">
                                        <br>
                                        @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <label>Tanggal Lahir</label>
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
                                            name="alamat" required placeholder="Alamat"
                                            style="height: 100px">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kontak & Social Media Section -->
                        <div class="mb-4 section-card">
                            <div class="mb-3 section-header d-flex align-items-center">
                                <i class="fas fa-address-book text-primary me-2"></i>
                                <h5 class="mb-0 text-primary">Kontak & Social Media</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating" style="margin-bottom: 10px;">
                                        <label for="no_hp">No. HP</label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                            name="no_hp" value="{{ old('no_hp') }}" id="no_hp" placeholder="No. HP"
                                            pattern="[0-9]*" inputmode="numeric" maxlength="15"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" id="email" required
                                            placeholder="Email">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <label for="akun_fb">Facebook</label>
                                                <input type="text"
                                                    class="form-control @error('akun_fb') is-invalid @enderror"
                                                    name="akun_fb" value="{{ old('akun_fb') }}" id="akun_fb"
                                                    placeholder="Facebook">
                                                @error('akun_fb')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <label for="akun_ig">Instagram</label>
                                                <input type="text"
                                                    class="form-control @error('akun_ig') is-invalid @enderror"
                                                    name="akun_ig" value="{{ old('akun_ig') }}" id="akun_ig"
                                                    placeholder="Instagram">
                                                @error('akun_ig')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <label for="akun_tiktok">TikTok</label>
                                                <input type="text"
                                                    class="form-control @error('akun_tiktok') is-invalid @enderror"
                                                    name="akun_tiktok" value="{{ old('akun_tiktok') }}" id="akun_tiktok"
                                                    placeholder="TikTok">
                                                @error('akun_tiktok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="mb-4 section-card">
                            <div class="mb-3 section-header d-flex align-items-center">
                                <i class="fas fa-lock text-primary me-2"></i>
                                <h5 class="mb-0 text-primary">Password</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6" style="margin-bottom: 10px;">
                                    <div class="form-floating">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required placeholder="Password">
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="password_confirmation"
                                            required placeholder="Konfirmasi Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="gap-3 text-end d-flex justify-content-end">
                            <a href="{{ route('home') }}" class="px-4 btn btn-secondary btn-lg px-lg-5"
                                style="margin-right: 10px;">
                                <i class="fas fa-times me-2"></i>{{ __('Cancel') }}
                            </a>
                            <button type="button" class="px-4 btn btn-primary btn-lg px-lg-5" id="showTermsButton">
                                <i class="fas fa-user-plus me-2"></i><span class="button-text">{{ __('Register')
                                    }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Terms of Service Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="text-white modal-header bg-primary">
                <h5 class="modal-title" id="termsModalLabel">
                    <i class="fas fa-file-contract me-2"></i>Terms of Service
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 terms-content">
                    <h6 class="fw-bold">Syarat dan Ketentuan Pendaftaran Alumni:</h6>
                    <ol>
                        <li>Saya menyatakan bahwa semua informasi yang saya berikan adalah benar dan akurat.</li>
                        <li>Saya setuju untuk memberikan data pribadi saya untuk keperluan pendataan alumni.</li>
                        <li>Saya memahami bahwa akun saya perlu diverifikasi oleh admin sebelum dapat mengakses fitur
                            lengkap.</li>
                        <li>Saya setuju untuk mematuhi semua aturan dan ketentuan yang berlaku di platform ini.</li>
                    </ol>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="agreeTerms">
                    <label class="form-check-label" for="agreeTerms">
                        Saya telah membaca dan menyetujui syarat dan ketentuan di atas
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Tutup
                </button>
                <button type="button" class="btn btn-primary" id="submitButton" disabled onclick="submitForm()">
                    <i class="fas fa-check me-2"></i>Setuju & Daftar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .button-spinner {
        display: inline-block;
        width: 1rem;
        height: 1rem;
        border: 0.2em solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        animation: button-spinner 0.75s linear infinite;
        margin-right: 0.5rem;
    }

    @keyframes button-spinner {
        to {
            transform: rotate(360deg);
        }
    }

    @media screen and (max-width: 768px) {
        .form-floating {
            font-size: 14px;
        }

        .form-floating .form-select,
        .form-floating .form-control {
            height: 45px;
            padding-top: 1rem;
            padding-bottom: 0.5rem;
        }

        .form-floating label {
            padding: 0.5rem 0.75rem;
        }

        .form-floating>.form-select {
            padding-top: 1.25rem;
            padding-bottom: 0.25rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form.needs-validation');
    const showTermsButton = document.getElementById('showTermsButton');
    const submitButton = document.getElementById('submitButton');
    const agreeTerms = document.getElementById('agreeTerms');
    const termsModal = new bootstrap.Modal(document.getElementById('termsModal'));

    // Show terms modal when clicking register button
    showTermsButton.addEventListener('click', function() {
        termsModal.show();
    });

    // Enable/disable submit button based on checkbox
    agreeTerms.addEventListener('change', function() {
        submitButton.disabled = !this.checked;
    });
});

// Function to submit the form
function submitForm() {
    const form = document.querySelector('form.needs-validation');
    const submitButton = document.getElementById('submitButton');
    const spinner = document.createElement('span');
    spinner.className = 'button-spinner';
    
    // Prevent multiple submissions
    if (submitButton.disabled) {
        return;
    }

    // Disable button and show loading state
    submitButton.disabled = true;
    submitButton.innerHTML = '<span class="button-spinner"></span> Processing...';

    // Submit the form
    form.submit();

    // Enable button after 10 seconds (failsafe)
    setTimeout(function() {
        submitButton.disabled = false;
        submitButton.innerHTML = '<i class="fas fa-check me-2"></i>Setuju & Daftar';
    }, 10000);
}
</script>

@endsection