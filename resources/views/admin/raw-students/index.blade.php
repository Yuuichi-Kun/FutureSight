@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Siswa</h1>
        <a href="{{ route('admin.raw-students.create') }}" class="btn btn-primary">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Siswa
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">

            @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>NIK</th>
                            <th>Nama Depan</th>
                            <th>Nama Belakang</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rawStudents as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->nisn }}</td>
                            <td>{{ $student->nik }}</td>
                            <td>{{ $student->nama_depan }}</td>
                            <td>{{ $student->nama_belakang }}</td>
                            <td>{{ $student->tempat_lahir }}</td>
                            <td>{{ $student->tgl_lahir instanceof \Carbon\Carbon ? $student->tgl_lahir->format('d/m/Y') : '-' }}</td>
                            <td>{{ $student->alamat }}</td>
                            <td>
                                <a href="{{ route('admin.raw-students.edit', $student) }}" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.raw-students.destroy', $student) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $rawStudents->links() }}
        </div>
    </div>
</div>
@endsection 