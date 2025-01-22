@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Message Inbox</h1>
    </div>

    <!-- Messages -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Messages</h6>
        </div>
        <div class="card-body">
            @foreach($messages as $message)
                <div class="message-item p-3 border-bottom {{ !$message->is_read ? 'bg-light' : '' }}">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            @if($message->sender->avatar)
                                <img src="/avatars/{{ $message->sender->avatar }}" class="rounded-circle mr-2" 
                                    style="width:40px; height:40px; object-fit:cover;">
                            @else
                                <img src="{{ asset('/img/default_profile.png') }}" class="rounded-circle mr-2"
                                    style="width:40px; height:40px; object-fit:cover;">
                            @endif
                            <div>
                                <h6 class="mb-0">
                                    @if($message->is_system_message)
                                        <span class="badge badge-danger mr-1">System</span>
                                    @endif
                                    {{ $message->sender->name }}
                                    @if($message->sender->alumni)
                                        <small class="text-muted">(Alumni - {{ $message->sender->alumni->tahunLulus->tahun_lulus }})</small>
                                    @endif
                                </h6>
                                <small class="text-muted">{{ $message->created_at->format('M d, Y H:i') }}</small>
                            </div>
                        </div>
                        <a href="{{ route('admin.messages.show', $message->sender) }}" 
                           class="btn btn-sm btn-primary">
                            <i class="fas fa-reply fa-fw"></i> Reply
                        </a>
                    </div>
                    <p class="mb-0 {{ $message->is_system_message ? 'text-danger' : '' }}">
                        {{ $message->content }}
                    </p>
                </div>
            @endforeach

            <div class="mt-4">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 