@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Konsentrasi Keahlian</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.konsentrasi-keahlian.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_program_keahlian">Program Keahlian</label>
                            <select class="form-control @error('id_program_keahlian') is-invalid @enderror" 
                                    id="id_program_keahlian" name="id_program_keahlian">
                                <option value="">Pilih Program Keahlian</option>
                                @foreach($programKeahlian as $program)
                                    <option value="{{ $program->id_program_keahlian }}" 
                                            {{ old('id_program_keahlian') == $program->id_program_keahlian ? 'selected' : '' }}>
                                        {{ $program->bidangKeahlian->bidang_keahlian }} - {{ $program->program_keahlian }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_program_keahlian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kode_konsentrasi_keahlian">Kode Konsentrasi Keahlian</label>
                            <input type="text" class="form-control @error('kode_konsentrasi_keahlian') is-invalid @enderror" 
                                   id="kode_konsentrasi_keahlian" name="kode_konsentrasi_keahlian" 
                                   value="{{ old('kode_konsentrasi_keahlian') }}">
                            @error('kode_konsentrasi_keahlian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="konsentrasi_keahlian">Konsentrasi Keahlian</label>
                            <input type="text" class="form-control @error('konsentrasi_keahlian') is-invalid @enderror" 
                                   id="konsentrasi_keahlian" name="konsentrasi_keahlian" 
                                   value="{{ old('konsentrasi_keahlian') }}">
                            @error('konsentrasi_keahlian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.konsentrasi-keahlian.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection