@extends('layouts.user')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        @if($user->avatar)
                            <img src="/avatars/{{ $user->avatar }}" class="rounded-circle me-2" 
                                style="width:40px; height:40px; object-fit:cover; margin-right: 10px;">
                        @else
                            <i class="fas fa-user-circle fa-2x me-2"></i>
                        @endif
                        <h5 class="mb-0">{{ $user->name }}</h5>
                    </div>
                    <a href="{{ route('messages.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to Inbox
                    </a>
                </div>
                <div class="card-body" style="height: 400px; overflow-y: auto;">
                    @foreach($messages as $message)
                        <div class="mb-3 {{ $message->sender_id === auth()->id() ? 'text-end' : '' }}">
                            <div class="d-inline-block p-3 rounded-3 {{ $message->sender_id === auth()->id() ? 'bg-primary text-white' : 'bg-light' }}" 
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
                    <form action="{{ route('messages.store', $user) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="content" class="form-control" 
                                placeholder="Type your message..." required>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 