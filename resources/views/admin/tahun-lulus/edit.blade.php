@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Tahun Lulus</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tahun-lulus.update', $tahunLulus->id_tahun_lulus) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="tahun_lulus">Tahun Lulus</label>
                            <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror" 
                                   id="tahun_lulus" name="tahun_lulus" 
                                   value="{{ old('tahun_lulus', $tahunLulus->tahun_lulus) }}">
                            @error('tahun_lulus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" 
                                   id="keterangan" name="keterangan" 
                                   value="{{ old('keterangan', $tahunLulus->keterangan) }}">
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.tahun-lulus.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection