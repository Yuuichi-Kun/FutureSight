@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Persetujuan Alumni</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Permintaan Persetujuan Alumni</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tahun Lulus</th>
                            <th>Konsentrasi</th>
                            <th>Status Alumni</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingAlumni as $user)
                            <tr>
                                <td>
                                    @if($user->alumni)
                                        {{ $user->alumni->nama_depan }} {{ $user->alumni->nama_belakang }}
                                    @else
                                        {{ $user->name }}
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->alumni && $user->alumni->tahunLulus)
                                        {{ $user->alumni->tahunLulus->tahun_lulus }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($user->alumni && $user->alumni->konsentrasiKeahlian)
                                        {{ $user->alumni->konsentrasiKeahlian->konsentrasi_keahlian }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($user->alumni && $user->alumni->statusAlumni)
                                        {{ $user->alumni->statusAlumni->status_alumni }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{ route('alumni.approve', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui alumni ini?')">
                                                <i class="fas fa-check"></i> Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('alumni.reject', $user) }}" method="POST" class="d-inline ml-1">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tolak alumni ini?')">
                                                <i class="fas fa-times"></i> Tolak
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada permintaan persetujuan alumni</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $pendingAlumni->links() }}
        </div>
    </div>
</div>
@endsection 