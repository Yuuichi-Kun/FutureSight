@extends('layouts.user')

@section('title', 'Forum Alumni - Otakuspace')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <h2 class="mb-4">Forum Diskusi Alumni</h2>
            
            <!-- Create New Discussion -->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('forum.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Diskusi</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="general">Umum</option>
                                <option value="reunion">Reuni</option>
                                <option value="career">Karir</option>
                                <option value="education">Pendidikan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Isi Diskusi</label>
                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Buat Diskusi</button>
                    </form>
                </div>
            </div>

            <!-- Forum List -->
            @foreach($forums as $forum)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        @if($forum->user->avatar)
                            <img src="/avatars/{{ $forum->user->avatar }}" class="rounded-circle" style="width:40px; height:40px; object-fit:cover; margin-right: 10px;">
                        @else
                            <img src="{{ asset('/img/default_profile.png') }}" class="rounded-circle me-2" style="width:40px; height:40px; object-fit:cover; margin-right: 10px;">
                        @endif
                        <div>
                            <h5 class="card-title mb-0">
                                <a href="{{ route('forum.show', $forum) }}" class="text-decoration-none">{{ $forum->title }}</a>
                            </h5>
                            <small class="text-muted">Posted by 
                                <a href="{{ route('users.profile', $forum->user) }}" class="text-decoration-none">{{ $forum->user->name }}</a>
                                · {{ $forum->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                    <p class="card-text">{{ Str::limit($forum->content, 200) }}</p>
                    <div class="d-flex justify-content-between align-items-center" style="background-color: #f0f0f0; padding: 5px; border-radius: 5px;">
                        <span class="badge bg-light">{{ ucfirst($forum->category) }}</span>
                        <span>{{ $forum->comments->count() }} comments</span>
                    </div>
                </div>
            </div>
            @endforeach

            {{ $forums->links() }}
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Forum Categories</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Umum
                            <span class="badge bg-primary rounded-pill">{{ $forums->where('category', 'general')->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Reuni
                            <span class="badge bg-primary rounded-pill">{{ $forums->where('category', 'reunion')->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Karir
                            <span class="badge bg-primary rounded-pill">{{ $forums->where('category', 'career')->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Pendidikan
                            <span class="badge bg-primary rounded-pill">{{ $forums->where('category', 'education')->count() }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 