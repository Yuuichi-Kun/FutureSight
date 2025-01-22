@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Conversation with {{ $user->name }}</h1>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left fa-fw"></i> Back to Inbox
        </a>
    </div>

    <!-- Messages -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex align-items-center">
            <div class="d-flex align-items-center">
                @if($user->avatar)
                    <img src="/avatars/{{ $user->avatar }}" class="rounded-circle mr-2" 
                        style="width:40px; height:40px; object-fit:cover;">
                @else
                    <img src="{{ asset('/img/default_profile.png') }}" class="rounded-circle mr-2"
                        style="width:40px; height:40px; object-fit:cover;">
                @endif
                <div>
                    <h6 class="m-0 font-weight-bold text-primary">{{ $user->name }}</h6>
                    @if($user->alumni)
                        <small class="text-muted">Alumni - {{ $user->alumni->tahunLulus->tahun_lulus }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body" style="height: 400px; overflow-y: auto;">
            @foreach($messages as $message)
                <div class="mb-3 {{ $message->sender_id === auth()->id() ? 'text-right' : 'text-left' }}">
                    <div class="d-inline-block p-3 rounded {{ $message->sender_id === auth()->id() ? 'bg-primary text-white' : 'bg-light' }}" 
                         style="max-width: 70%;">
                        <p class="mb-1">{{ $message->content }}</p>
                        <small class="{{ $message->sender_id === auth()->id() ? 'text-white-50' : 'text-muted' }}">
                            {{ $message->created_at->format('M d, Y H:i') }}
                        </small>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="card-footer">
            <form action="{{ route('admin.messages.store', $user) }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="content" class="form-control" 
                        placeholder="Type your message..." required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Send
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 