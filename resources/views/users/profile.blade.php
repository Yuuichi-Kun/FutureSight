@extends('layouts.user')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <!-- Ubah gambar profil menjadi clickable dengan menambahkan style cursor pointer -->
                        <div style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#sendMessageModal{{ $profileUser->id }}">
                            @if($profileUser->avatar)
                                <img src="{{ asset('avatars/' . $profileUser->avatar) }}" 
                                     alt="Profile Picture" 
                                     class="rounded-circle me-3" 
                                     style="width: 64px; height: 64px; object-fit: cover; margin-right: 10px;"
                                     title="Click to send message to {{ $profileUser->name }}">
                            @else
                                <img src="{{ asset('img/Default_profile.png') }}" 
                                     alt="Default Profile Picture" 
                                     class="rounded-circle me-3" 
                                     style="width: 64px; height: 64px; object-fit: cover; margin-right: 10px;"
                                     title="Click to send message to {{ $profileUser->name }}">
                            @endif
                        </div>
                        <div>
                            <h4 class="mb-1">{{ $profileUser->name }}</h4>
                            @if($profileUser->alumni)
                                <p class="text-muted mb-0">Alumni - {{ $profileUser->alumni->tahunLulus->tahun_lulus }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('messages.show', $profileUser) }}" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-1"></i> Send Message
                        </a>
                    </div>

                    <!-- Add more profile information here as needed -->
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.send-message-modal')
@endsection