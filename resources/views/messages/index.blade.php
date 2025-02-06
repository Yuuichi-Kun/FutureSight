@extends('layouts.user')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="shadow-sm card">
                <div class="text-white card-header bg-primary">
                    <h5 class="mb-0"><i class="fas fa-inbox me-2"></i> Message Inbox</h5>
                </div>
                <div class="card-body">
                    @forelse($messages as $message)
                        <div class="message-item p-3 border-bottom {{ !$message->is_read ? 'bg-light' : '' }}">
                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    @if($message->sender->avatar)
                                        <img src="/avatars/{{ $message->sender->avatar }}" class="rounded-circle me-2"
                                            style="width:40px; height:40px; object-fit:cover;">
                                    @else
                                        <i class="fas fa-user-circle fa-2x me-2 text-secondary"></i>
                                    @endif
                                    <div>
                                        <h6 class="mb-0">
                                            @if($message->is_system_message)
                                                <span class="badge bg-danger me-1">System</span>
                                            @endif
                                            {{ $message->sender->name }}
                                        </h6>
                                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <a href="{{ route('messages.show', $message->sender) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-reply"></i> Reply
                                </a>
                            </div>
                            <p class="mb-0 {{ $message->is_system_message ? 'text-danger' : '' }}">
                                {{ $message->content }}
                            </p>
                        </div>
                    @empty
                        <p class="text-center text-muted">No messages yet.</p>
                    @endforelse

                    <div class="mt-4">
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
