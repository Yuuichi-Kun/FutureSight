@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Forum Monitoring</h1>
    </div>

    <!-- Forum Activities Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Recent Forum Activities</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Activity Type</th>
                            <th>Content</th>
                            <th>Category</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($forumActivities as $forum)
                            <!-- Forum Posts -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($forum->user->avatar)
                                            <img src="/avatars/{{ $forum->user->avatar }}" class="rounded-circle mr-2" 
                                                style="width:30px; height:30px; object-fit:cover;">
                                        @else
                                            <i class="fas fa-user-circle fa-2x mr-2 text-gray-300"></i>
                                        @endif
                                        {{ $forum->user->name }}
                                        @if($forum->user->is_banned)
                                            <span class="badge badge-danger ml-2">Banned</span>
                                        @endif
                                    </div>
                                </td>
                                <td><span class="badge badge-primary">Forum Post</span></td>
                                <td>{{ Str::limit($forum->content, 100) }}</td>
                                <td>{{ ucfirst($forum->category) }}</td>
                                <td>{{ $forum->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning btn-sm" 
                                            onclick="event.preventDefault();
                                                if(confirm('Send warning to {{ $forum->user->name }}?')) {
                                                    document.getElementById('warn-form-{{ $forum->user->id }}').submit();
                                                }">
                                            <i class="fas fa-exclamation-triangle"></i> Warn
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="event.preventDefault();
                                                if(confirm('Ban {{ $forum->user->name }}?')) {
                                                    document.getElementById('ban-form-{{ $forum->user->id }}').submit();
                                                }">
                                            <i class="fas fa-ban"></i> Ban
                                        </button>
                                    </div>
                                    <form id="warn-form-{{ $forum->user->id }}" 
                                        action="{{ route('admin.forum.warn', $forum->user) }}" 
                                        method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <form id="ban-form-{{ $forum->user->id }}" 
                                        action="{{ route('admin.forum.ban', $forum->user) }}" 
                                        method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            <!-- Comments for this forum post -->
                            @foreach($forum->comments as $comment)
                                <tr class="bg-light">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($comment->user->avatar)
                                                <img src="/avatars/{{ $comment->user->avatar }}" class="rounded-circle mr-2" 
                                                    style="width:30px; height:30px; object-fit:cover;">
                                            @else
                                                <i class="fas fa-user-circle fa-2x mr-2 text-gray-300"></i>
                                            @endif
                                            {{ $comment->user->name }}
                                            @if($comment->user->is_banned)
                                                <span class="badge badge-danger ml-2">Banned</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td><span class="badge badge-info">Comment</span></td>
                                    <td>{{ Str::limit($comment->content, 100) }}</td>
                                    <td>-</td>
                                    <td>{{ $comment->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning btn-sm" 
                                                onclick="event.preventDefault();
                                                    if(confirm('Send warning to {{ $comment->user->name }}?')) {
                                                        document.getElementById('warn-form-{{ $comment->user->id }}').submit();
                                                    }">
                                                <i class="fas fa-exclamation-triangle"></i> Warn
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="event.preventDefault();
                                                    if(confirm('Ban {{ $comment->user->name }}?')) {
                                                        document.getElementById('ban-form-{{ $comment->user->id }}').submit();
                                                    }">
                                                <i class="fas fa-ban"></i> Ban
                                            </button>
                                        </div>
                                        <form id="warn-form-{{ $comment->user->id }}" 
                                            action="{{ route('admin.forum.warn', $comment->user) }}" 
                                            method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <form id="ban-form-{{ $comment->user->id }}" 
                                            action="{{ route('admin.forum.ban', $comment->user) }}" 
                                            method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-4">
                {{ $forumActivities->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 