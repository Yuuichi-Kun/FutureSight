@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Alumni</h1>
    </div>

    <!-- Alumni Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Alumni</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tahun Lulus</th>
                            <th>Konsentrasi Keahlian</th>
                            <th>Status</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alumni as $a)
                        <tr>
                            <td>{{ $a->nama_depan }} {{ $a->nama_belakang }}</td>
                            <td>{{ $a->tahunLulus->tahun_lulus }}</td>
                            <td>{{ $a->konsentrasiKeahlian->konsentrasi_keahlian }}</td>
                            <td>
                                <span class="badge badge-info">{{ $a->statusAlumni->status_alumni }}</span>
                                @if($a->additionalStatus->count() > 0)
                                    @foreach($a->additionalStatus as $status)
                                        <br><span class="badge badge-info">{{ $status->status_alumni }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ $a->email }}</td>
                            <td>
                                <a href="{{ route('admin.alumni.show', $a) }}" 
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data alumni</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $alumni->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "pageLength": 10,
        "ordering": true,
        "info": true,
        "searching": true
    });
});
</script>
@endpush 