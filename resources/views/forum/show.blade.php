@extends('layouts.user')

@section('title', $forum->title . ' - Forum Alumni')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <!-- Forum Detail -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        @if($forum->user->avatar)
                            <img src="/avatars/{{ $forum->user->avatar }}" class="rounded-circle me-2" style="width:50px; height:50px; object-fit:cover; border: 3px solid #e9ecef; margin-right: 10px;">
                        @else
                            <img src="{{ asset('/img/default_profile.png') }}" class="rounded-circle me-2" style="width:50px; height:50px; object-fit:cover; border: 3px solid #e9ecef; margin-right: 10px;">
                        @endif
                        <div>
                            <h4 class="mb-0 fw-bold">{{ $forum->title }}</h4>
                            <small class="text-muted">
                                <i class="fas fa-user-circle me-1"></i>
                                <a href="{{ route('users.profile', $forum->user) }}" class="text-decoration-none">{{ $forum->user->name }}</a>
                                · <i class="far fa-clock me-1"></i> {{ $forum->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                    <p class="card-text lead">{{ $forum->content }}</p>
                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3">
                        <span class="badge bg-info text-light px-3 py-2">{{ ucfirst($forum->category) }}</span>
                        <span><i class="far fa-comment-alt"></i> {{ $forum->comments->count() }} comments</span>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="fas fa-comment-dots me-2" style="margin-right: 10px;"></i>Add Comment
                    </h5>

                    <!-- Comment Form -->
                    <form action="{{ route('forum.comment', $forum) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea class="form-control" name="content" rows="3" 
                                placeholder="Share your thoughts..." required 
                                style="border-radius: 15px;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 rounded-pill">
                            <i class="fas fa-paper-plane me-2" style="margin-right: 10px;"></i>Post Comment
                        </button>
                    </form>
                </div>
            </div>

            <!-- Comments List -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="fas fa-comments me-2" style="margin-right: 10px;"></i>Comments ({{ $forum->comments->count() }})
                    </h5>
                    @foreach($forum->comments as $comment)
                    <div class="d-flex mb-4">
                        @if($comment->user->avatar)
                            <img src="/avatars/{{ $comment->user->avatar }}" class="rounded-circle me-2" 
                                style="width:45px; height:45px; object-fit:cover; border: 2px solid #e9ecef;">
                        @else
                            <img src="{{ asset('/img/default_profile.png') }}" class="rounded-circle me-2" 
                                style="width:45px; height:45px; object-fit:cover; border: 2px solid #e9ecef;">
                        @endif
                        <div class="flex-grow-1">
                            <div class="bg-light p-3 rounded-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0 fw-bold">
                                        <a href="{{ route('users.profile', $comment->user) }}" class="text-decoration-none">{{ $comment->user->name }}</a>
                                    </h6>
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted me-3">
                                            <i class="far fa-clock me-1"></i>{{ $comment->created_at->diffForHumans() }}
                                        </small>
                                        @if(auth()->id() === $comment->user_id)
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-outline-primary" 
                                                    onclick="editComment({{ $comment->id }}, '{{ addslashes($comment->content) }}')">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('forum.comment.destroy', $comment) }}" 
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                        onclick="return confirm('Are you sure you want to delete this comment?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <p class="mb-0" id="comment-content-{{ $comment->id }}">{{ $comment->content }}</p>
                            </div>
                            <!-- Edit Form (Hidden by default) -->
                            <div id="edit-form-{{ $comment->id }}" style="display: none;" class="mt-2">
                                <form action="{{ route('forum.comment.update', $comment) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-2">
                                        <textarea class="form-control" name="content" rows="2" 
                                            required style="border-radius: 10px;">{{ $comment->content }}</textarea>
                                    </div>
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-check me-1"></i>Update
                                        </button>
                                        <button type="button" class="btn btn-sm btn-secondary" 
                                            onclick="cancelEdit({{ $comment->id }})">
                                            <i class="fas fa-times me-1"></i>Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Add JavaScript for edit functionality -->
            <script>
                function editComment(commentId, content) {
                    document.getElementById(`comment-content-${commentId}`).style.display = 'none';
                    document.getElementById(`edit-form-${commentId}`).style.display = 'block';
                }

                function cancelEdit(commentId) {
                    document.getElementById(`comment-content-${commentId}`).style.display = 'block';
                    document.getElementById(`edit-form-${commentId}`).style.display = 'none';
                }
            </script>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-info-circle me-2" style="margin-right: 10px;"></i>About This Discussion
                    </h5>
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <i class="fas fa-user-circle fa-2x text-primary" style="margin-right: 10px;"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Started by</h6>
                            <p class="mb-0 text-muted">{{ $forum->user->name }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <i class="fas fa-calendar-alt fa-2x text-primary" style="margin-right: 10px;"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Created</h6>
                            <p class="mb-0 text-muted">{{ $forum->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-tag fa-2x text-primary" style="margin-right: 10px;"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Category</h6>
                            <p class="mb-0 text-muted">{{ ucfirst($forum->category) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 