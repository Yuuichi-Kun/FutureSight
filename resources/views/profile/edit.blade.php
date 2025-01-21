@extends('layouts.app')

@section('content')
<div class="profile-container">
    <!-- Profile Information Section -->
    <div class="profile-section">
        <h3 class="section-header">{{ __('Profile Information') }}</h3>
        <div class="p-4">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Avatar Upload Section -->
    <div class="profile-section">
        <h3 class="section-header">{{ __('Profile Picture') }}</h3>
        <div class="p-4">
            <form method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="avatar-upload">
                    <div class="current-avatar-container">
                        @if(Auth::user()->avatar)
                            <img class="current-avatar" src="/avatars/{{ Auth::user()->avatar }}" alt="Current Avatar" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <img class="current-avatar" src="{{ asset('/img/default_profile.png') }}" alt="Default Avatar" style="width: 100px; height: 100px; object-fit: cover;">
                        @endif
                    </div>
                    
                    <div class="upload-controls">
                        <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" required>
                        @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button type="submit" class="btn btn-custom mt-3">
                            {{ __('Update Profile Picture') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Password Update Section -->
    <div class="profile-section">
        <h3 class="section-header">{{ __('Update Password') }}</h3>
        <div class="p-4">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <!-- Delete Account Section -->
    <div class="profile-section">
        <h3 class="section-header">{{ __('Delete Account') }}</h3>
        <div class="p-4">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection