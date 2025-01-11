@extends('layouts.appUser')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    @section('content')
    <div>
        <div class="">
            <div class="p-4 sm:p-8 bg-white shadow rounded sm:rounded-lg" style="margin: 10px;">
                <div class="max-w-xl">
                    @include('profileUser.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow rounded sm:rounded-lg" style="margin: 10px;">
                <div class="max-w-xl">
                    @include('profileUser.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow rounded sm:rounded-lg" style="margin: 10px;">
                <div class="max-w-xl">
                    @include('profileUser.partials.delete-user-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow rounded sm:rounded-lg" style="margin: 10px;">
            <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="row mb-3">
                            <label for="avatar" class="col-md-4 col-form-label text-md-end">{{ __('Avatar') }}</label>
                            <div class="col-md-6">
                                <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}" required autocomplete="avatar">
                                <img src="/avatars/{{ Auth::user()->avatar }}" style="width:80px;margin-top: 10px;">
                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Upload Profile') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div> 
        </div>
    </div>
    @endsection
    

