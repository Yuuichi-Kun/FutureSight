@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Profile Sekolah</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($school) ? 'Edit Profile Sekolah' : 'Tambah Profile Sekolah' }}</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($school) ? route('admin.school.update', $school->id_sekolah) : route('admin.school.store') }}">
                @csrf
                @if(isset($school))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label>NPSN</label>
                    <input type="text" class="form-control @error('npsn') is-invalid @enderror" name="npsn" 
                           value="{{ old('npsn', $school->npsn ?? '') }}">
                    @error('npsn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>NSS</label>
                    <input type="text" class="form-control @error('nss') is-invalid @enderror" name="nss"
                           value="{{ old('nss', $school->nss ?? '') }}">
                    @error('nss')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nama Sekolah</label>
                    <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" name="nama_sekolah"
                           value="{{ old('nama_sekolah', $school->nama_sekolah ?? '') }}">
                    @error('nama_sekolah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                           value="{{ old('alamat', $school->alamat ?? '') }}">
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp"
                           value="{{ old('no_telp', $school->no_telp ?? '') }}">
                    @error('no_telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Website</label>
                    <input type="text" class="form-control @error('website') is-invalid @enderror" name="website"
                           value="{{ old('website', $school->website ?? '') }}">
                    @error('website')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email', $school->email ?? '') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ isset($school) ? 'Update' : 'Simpan' }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection