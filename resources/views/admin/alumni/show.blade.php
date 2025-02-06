@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Detail Alumni</h1>
        <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <!-- Data Diri Alumni -->
        <div class="col-xl-4 col-lg-5">
            <div class="mb-4 shadow card">
                <div class="py-3 card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Data Diri Alumni</h6>
                </div>
                <div class="card-body">
                    <div class="mb-4 text-center">
                        <img class="img-profile rounded-circle"
                            src="{{ $alumni->user && $alumni->user->avatar ? asset('avatars/' . $alumni->user->avatar) : asset('img/Default_profile.png') }}"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <dl class="row">
                        <dt class="col-sm-4">Nama Lengkap</dt>
                        <dd class="col-sm-8">{{ $alumni->nama_depan }} {{ $alumni->nama_belakang }}</dd>

                        <dt class="col-sm-4">NISN</dt>
                        <dd class="col-sm-8">{{ $alumni->nisn ?? '-' }}</dd>

                        <dt class="col-sm-4">Tahun Lulus</dt>
                        <dd class="col-sm-8">{{ $alumni->tahunLulus->tahun_lulus }}</dd>

                        <dt class="col-sm-4">Keahlian</dt>
                        <dd class="col-sm-8">{{ $alumni->konsentrasiKeahlian->konsentrasi_keahlian }}</dd>

                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">
                            <span class="badge badge-info">{{ $alumni->statusAlumni->status_alumni }}</span>
                            @if($alumni->additionalStatus->count() > 0)
                            @foreach($alumni->additionalStatus as $status)
                            <br><span class="badge badge-info">{{ $status->status_alumni }}</span>
                            @endforeach
                            @endif
                        </dd>

                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">{{ $alumni->email }}</dd>

                        <dt class="col-sm-4">No. HP</dt>
                        <dd class="col-sm-8">{{ $alumni->no_hp ?? '-' }}</dd>

                        <dt class="col-sm-4">Alamat</dt>
                        <dd class="col-sm-8">{{ $alumni->alamat }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Tracer Study Data -->
        <div class="col-xl-8 col-lg-7">
            <!-- Tracer Kerja -->
            @if($alumni->tracerKerja)
            <div class="mb-4 shadow card">
                <div class="py-3 card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Data Tracer Kerja</h6>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Pekerjaan</dt>
                        <dd class="col-sm-8">{{ $alumni->tracerKerja->tracer_kerja_pekerjaan }}</dd>

                        <dt class="col-sm-4">Perusahaan</dt>
                        <dd class="col-sm-8">{{ $alumni->tracerKerja->tracer_kerja_nama }}</dd>

                        <dt class="col-sm-4">Jenis Perusahaan</dt>
                        <dd class="col-sm-8">{{ $alumni->tracerKerja->jenis_perusahaan }}</dd>

                        <dt class="col-sm-4">Bentuk Lembaga</dt>
                        <dd class="col-sm-8">{{ $alumni->tracerKerja->bentuk_lembaga }}</dd>

                        <dt class="col-sm-4">Jabatan</dt>
                        <dd class="col-sm-8">{{ $alumni->tracerKerja->tracer_kerja_jabatan }}</dd>

                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">{{ $alumni->tracerKerja->tracer_kerja_status }}</dd>

                        <dt class="col-sm-4">Gaji</dt>
                        <dd class="col-sm-8">{{ $alumni->tracerKerja->tracer_kerja_gaji }}</dd>
                    </dl>
                </div>
            </div>
            @endif

            <!-- Tracer Kuliah -->
            @if($alumni->tracerKuliah)
            <div class="mb-4 shadow card">
                <div class="py-3 card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Data Tracer Kuliah</h6>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Kampus</dt>
                        <dd class="col-sm-8">{{ $alumni->tracerKuliah->tracer_kuliah_kampus }}</dd>

                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">{{ $alumni->tracerKuliah->tracer_kuliah_status }}</dd>

                        <dt class="col-sm-4">Jenjang</dt>
                        <dd class="col-sm-8">{{ $alumni->tracerKuliah->tracer_kuliah_jenjang }}</dd>

                        <dt class="col-sm-4">Jurusan</dt>
                        <dd class="col-sm-8">{{ $alumni->tracerKuliah->tracer_kuliah_jurusan }}</dd>

                        <dt class="col-sm-4">Linier</dt>
                        <dd class="col-sm-8">{{ $alumni->tracerKuliah->tracer_kuliah_linier }}</dd>
                    </dl>
                </div>
            </div>
            @endif

            <!-- Testimoni -->
            @if($alumni->testimoni)
            <div class="mb-4 shadow card">
                <div class="py-3 card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Testimoni</h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $alumni->testimoni->testimoni }}</p>
                    <small class="text-muted">
                        Ditulis pada: {{ $alumni->testimoni->tgl_testimoni->format('d F Y') }}
                    </small>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection