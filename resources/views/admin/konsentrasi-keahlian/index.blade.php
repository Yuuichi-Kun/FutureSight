@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Konsentrasi Keahlian</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.konsentrasi-keahlian.create') }}" class="btn btn-primary">
                            Tambah Konsentrasi Keahlian
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bidang Keahlian</th>
                                <th>Program Keahlian</th>
                                <th>Kode</th>
                                <th>Konsentrasi Keahlian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($konsentrasiKeahlian as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->programKeahlian->bidangKeahlian->bidang_keahlian }}</td>
                                <td>{{ $item->programKeahlian->program_keahlian }}</td>
                                <td>{{ $item->kode_konsentrasi_keahlian }}</td>
                                <td>{{ $item->konsentrasi_keahlian }}</td>
                                <td>
                                    <a href="{{ route('admin.konsentrasi-keahlian.edit', $item->id_konsentrasi_keahlian) }}" 
                                       class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.konsentrasi-keahlian.destroy', $item->id_konsentrasi_keahlian) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection