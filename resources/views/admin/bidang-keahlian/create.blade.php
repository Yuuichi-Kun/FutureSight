@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Bidang Keahlian</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.bidang-keahlian.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="kode_bidang_keahlian">Kode Bidang Keahlian</label>
                            <input type="text" class="form-control @error('kode_bidang_keahlian') is-invalid @enderror" 
                                   id="kode_bidang_keahlian" name="kode_bidang_keahlian" value="{{ old('kode_bidang_keahlian') }}">
                            @error('kode_bidang_keahlian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bidang_keahlian">Bidang Keahlian</label>
                            <input type="text" class="form-control @error('bidang_keahlian') is-invalid @enderror" 
                                   id="bidang_keahlian" name="bidang_keahlian" value="{{ old('bidang_keahlian') }}">
                            @error('bidang_keahlian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.bidang-keahlian.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection