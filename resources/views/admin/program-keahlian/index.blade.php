@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Program Keahlian</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.program-keahlian.create') }}" class="btn btn-primary">
                            Tambah Program Keahlian
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
                                <th>Kode</th>
                                <th>Program Keahlian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($programKeahlian as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->bidangKeahlian->bidang_keahlian }}</td>
                                <td>{{ $item->kode_program_keahlian }}</td>
                                <td>{{ $item->program_keahlian }}</td>
                                <td>
                                    <a href="{{ route('admin.program-keahlian.edit', $item->id_program_keahlian) }}" 
                                       class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.program-keahlian.destroy', $item->id_program_keahlian) }}" 
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