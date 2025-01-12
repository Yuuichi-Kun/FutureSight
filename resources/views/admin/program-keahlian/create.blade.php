@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Program Keahlian</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.program-keahlian.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_bidang_keahlian">Bidang Keahlian</label>
                            <select class="form-control @error('id_bidang_keahlian') is-invalid @enderror" 
                                    id="id_bidang_keahlian" name="id_bidang_keahlian">
                                <option value="">Pilih Bidang Keahlian</option>
                                @foreach($bidangKeahlian as $bidang)
                                    <option value="{{ $bidang->id_bidang_keahlian }}" 
                                            {{ old('id_bidang_keahlian') == $bidang->id_bidang_keahlian ? 'selected' : '' }}>
                                        {{ $bidang->bidang_keahlian }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_bidang_keahlian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kode_program_keahlian">Kode Program Keahlian</label>
                            <input type="text" class="form-control @error('kode_program_keahlian') is-invalid @enderror" 
                                   id="kode_program_keahlian" name="kode_program_keahlian" value="{{ old('kode_program_keahlian') }}">
                            @error('kode_program_keahlian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="program_keahlian">Program Keahlian</label>
                            <input type="text" class="form-control @error('program_keahlian') is-invalid @enderror" 
                                   id="program_keahlian" name="program_keahlian" value="{{ old('program_keahlian') }}">
                            @error('program_keahlian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.program-keahlian.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection