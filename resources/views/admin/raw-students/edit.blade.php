@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Siswa</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.raw-students.update', $rawStudent) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>NISN</label>
                            <input type="text" 
                                   class="form-control @error('nisn') is-invalid @enderror" 
                                   name="nisn" 
                                   value="{{ old('nisn', $rawStudent->nisn) }}">
                            @error('nisn')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" 
                                   class="form-control @error('nik') is-invalid @enderror" 
                                   name="nik" 
                                   value="{{ old('nik', $rawStudent->nik) }}">
                            @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Depan</label>
                            <input type="text" 
                                   class="form-control @error('nama_depan') is-invalid @enderror" 
                                   name="nama_depan" 
                                   value="{{ old('nama_depan', $rawStudent->nama_depan) }}" 
                                   required>
                            @error('nama_depan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Belakang</label>
                            <input type="text" 
                                   class="form-control @error('nama_belakang') is-invalid @enderror" 
                                   name="nama_belakang" 
                                   value="{{ old('nama_belakang', $rawStudent->nama_belakang) }}" 
                                   required>
                            @error('nama_belakang')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" 
                                   class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                   name="tempat_lahir" 
                                   value="{{ old('tempat_lahir', $rawStudent->tempat_lahir) }}">
                            @error('tempat_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" 
                                   class="form-control @error('tgl_lahir') is-invalid @enderror" 
                                   name="tgl_lahir" 
                                   value="{{ old('tgl_lahir', $rawStudent->tgl_lahir instanceof \Carbon\Carbon ? $rawStudent->tgl_lahir->format('Y-m-d') : '') }}">
                            @error('tgl_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                      name="alamat" 
                                      rows="3">{{ old('alamat', $rawStudent->alamat) }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('admin.raw-students.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 