@extends('layouts.user')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Profile Sekolah</h5>
                </div>
                <div class="card-body">
                    @if($school)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th width="30%">NPSN</th>
                                        <td>{{ $school->npsn }}</td>
                                    </tr>
                                    <tr>
                                        <th>NSS</th>
                                        <td>{{ $school->nss }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Sekolah</th>
                                        <td>{{ $school->nama_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $school->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. Telepon</th>
                                        <td>{{ $school->no_telp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Website</th>
                                        <td>
                                            <a href="{{ $school->website }}" target="_blank" class="text-primary">
                                                {{ $school->website }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>
                                            <a href="mailto:{{ $school->email }}" class="text-primary">
                                                {{ $school->email }}
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            Data profile sekolah belum tersedia.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection