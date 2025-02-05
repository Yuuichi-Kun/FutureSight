@extends('layouts.user')

@section('title', 'Kuesioner Alumni')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold text-primary mb-3">Kuesioner Alumni</h2>
                <p class="text-muted lead">Bantu kami meningkatkan kualitas pendidikan dengan mengisi data di bawah ini</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Progress Steps -->
            <div class="progress-steps mb-5" data-aos="fade-up">
                <div class="step active" data-step="1">
                    <div class="step-icon"><i class="fas fa-briefcase"></i></div>
                    <span>Pekerjaan</span>
                </div>
                <div class="step" data-step="2">
                    <div class="step-icon"><i class="fas fa-graduation-cap"></i></div>
                    <span>Kuliah</span>
                </div>
                <div class="step" data-step="3">
                    <div class="step-icon"><i class="fas fa-comment-alt"></i></div>
                    <span>Testimoni</span>
                </div>
            </div>

            <!-- Form Sections -->
            <div class="form-sections">
                <!-- Data Pekerjaan -->
                <div class="form-section active" id="section1" data-aos="fade-up">
                    <div class="card shadow border-0 rounded-4">
                        <div class="card-header bg-primary bg-gradient text-white py-3 rounded-top-4">
                            <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i>Data Pekerjaan</h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('questionnaire.store.kerja') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="form-floating" style="margin-bottom: 10px;">
                                        <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" class="form-control" id="pekerjaan" name="tracer_kerja_pekerjaan" placeholder="Pekerjaan" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                        <label for="perusahaan">Nama Perusahaan</label>
                                            <input type="text" class="form-control" id="perusahaan" name="tracer_kerja_nama" placeholder="Nama Perusahaan" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="jenisPerusahaan">Jenis Perusahaan</label>
                                        <div class="form-floating">
                                            <select class="form-select" id="jenisPerusahaan" name="jenis_perusahaan" required style="margin-bottom: 10px;">
                                                <option value="BUMN">BUMN</option>
                                                <option value="Swasta">Swasta</option>
                                                <option value="Wiraswasta">Wiraswasta</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="bentukLembaga">Bentuk Lembaga</label>
                                        <div class="form-floating">
                                            <select class="form-select" id="bentukLembaga" name="bentuk_lembaga" required>
                                                <option value="PT">PT</option>
                                                <option value="CV">CV</option>
                                                <option value="Firma">Firma</option>
                                                <option value="Perseorangan">Perorangan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating" style="margin-bottom: 10px;">
                                        <label for="jabatan">Jabatan</label>
                                            <input type="text" class="form-control" id="jabatan" name="tracer_kerja_jabatan" placeholder="Jabatan" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="status">Status</label>
                                        <div class="form-floating">
                                            <select class="form-select" id="status" name="tracer_kerja_status" required>
                                                <option value="Tetap">Tetap</option>
                                                <option value="Kontrak">Kontrak</option>
                                                <option value="Freelance">Freelance</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating" style="margin-bottom: 10px;">
                                        <label for="lokasi">Lokasi</label>
                                            <input type="text" class="form-control" id="lokasi" name="tracer_kerja_lokasi" placeholder="Lokasi" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                        <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="tracer_kerja_alamat" placeholder="Alamat" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating" style="margin-bottom: 10px;">
                                        <label for="tanggalMulai">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="tanggalMulai" name="tracer_kerja_tgl_mulai" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                    <label for="tanggalMulai">Tanggal Mulai</label>
                                        <div class="form-floating">
                                            <select class="form-select" id="gaji" name="tracer_kerja_gaji" required>
                                                <option value="< 1 juta">< 1 juta</option>
                                                <option value="1-3 juta">1-3 juta</option>
                                                <option value="3-5 juta">3-5 juta</option>
                                                <option value="> 5 juta">> 5 juta</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-3">
                                        <i class="fas fa-save me-2"></i>Simpan & Lanjutkan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Data Kuliah -->
                <div class="form-section" id="section2" data-aos="fade-up">
                    <div class="card shadow border-0 rounded-4">
                        <div class="card-header bg-success bg-gradient text-white py-3 rounded-top-4">
                            <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Data Kuliah</h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('questionnaire.store.kuliah') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="form-floating" style="margin-bottom: 10px;">
                                            <label for="kampus">Nama Kampus</label>
                                            <input type="text" class="form-control" id="kampus" name="tracer_kuliah_kampus" placeholder="Nama Kampus" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="statusKampus">Status</label>
                                        <div class="form-floating">
                                            <select class="form-select" id="statusKampus" name="tracer_kuliah_status" required>
                                                <option value="Negeri">Negeri</option>
                                                <option value="Swasta">Swasta</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="jenjang">Jenjang</label>
                                        <div class="form-floating">
                                            <select class="form-select" id="jenjang" name="tracer_kuliah_jenjang" required>
                                                <option value="D3">D3</option>
                                                <option value="D4">D4</option>
                                                <option value="S1">S1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating" style="margin-bottom: 10px;">
                                            <label for="jurusan">Jurusan</label>
                                            <input type="text" class="form-control" id="jurusan" name="tracer_kuliah_jurusan" placeholder="Jurusan" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="linear">Linear dengan SMK?</label>
                                        <div class="form-floating">
                                            <select class="form-select" id="linear" name="tracer_kuliah_linier" required>
                                                <option value="Ya">Ya</option>
                                                <option value="Tidak">Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating" style="margin-bottom: 10px;">
                                            <label for="alamatKampus">Alamat Kampus</label>
                                            <input type="text" class="form-control" id="alamatKampus" name="tracer_kuliah_alamat" placeholder="Alamat Kampus" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success px-4 py-2 rounded-3">
                                        <i class="fas fa-save me-2"></i>Simpan & Lanjutkan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Testimoni -->
                <div class="form-section" id="section3" data-aos="fade-up">
                    <div class="card shadow border-0 rounded-4">
                        <div class="card-header bg-info bg-gradient text-white py-3 rounded-top-4">
                            <h5 class="mb-0"><i class="fas fa-comment-alt me-2"></i>Testimoni</h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('questionnaire.store.testimoni') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                <div class="form-floating">
                                    <textarea class="form-control" id="testimoni" name="testimoni" style="height: 150px" placeholder="Minimal 10 karakter" required></textarea>
                                    <label for="testimoni">Testimoni Anda</label>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-info text-white px-4 py-2 rounded-3">
                                        <i class="fas fa-save me-2"></i>Simpan Testimoni
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Progress Steps */
.progress-steps {
    display: flex;
    justify-content: space-between;
    margin-bottom: 2rem;
    position: relative;
}

.progress-steps::before {
    content: '';
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    height: 2px;
    width: 100%;
    background: #e9ecef;
    z-index: -1;
}

.step {
    text-align: center;
    position: relative;
    z-index: 1;
}

.step-icon {
    width: 50px;
    height: 50px;
    background: #fff;
    border: 2px solid #e9ecef;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.5rem;
    transition: all 0.3s ease;
}

.step.active .step-icon {
    background: var(--bs-primary);
    border-color: var(--bs-primary);
    color: white;
}

.step span {
    font-size: 0.875rem;
    color: #6c757d;
}

/* Form Enhancements */
.form-floating > .form-control,
.form-floating > .form-select {
    height: 3.5rem;
    padding: 1rem 0.75rem;
}

.form-floating > .form-control:focus,
.form-floating > .form-select:focus {
    border-color: var(--bs-primary);
    box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
}

.card {
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Animations */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-section {
    display: none;
    animation: slideIn 0.4s ease forwards;
}

.form-section.active {
    display: block;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .progress-steps {
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }
    
    .progress-steps::before {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });

    // Progress steps navigation
    const steps = document.querySelectorAll('.step');
    const sections = document.querySelectorAll('.form-section');
    
    steps.forEach((step, index) => {
        step.addEventListener('click', () => {
            // Remove active class from all steps and sections
            steps.forEach(s => s.classList.remove('active'));
            sections.forEach(s => s.classList.remove('active'));
            
            // Add active class to current step and section
            step.classList.add('active');
            sections[index].classList.add('active');
        });
    });
});
</script>
@endsection