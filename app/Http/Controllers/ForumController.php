<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumComment;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::with(['user', 'comments'])->latest()->paginate(10);
        return view('forum.index', compact('forums'));
    }

    public function show(Forum $forum)
    {
        $forum->load(['user', 'comments.user']);
        return view('forum.show', compact('forum'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->is_banned) {
            return back()->with('error', 'Your account has been banned from posting in the forum.');
        }
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required'
        ]);

        $forum = auth()->user()->forums()->create($validated);
        
        return redirect()->route('forum.show', $forum)
            ->with('success', 'Forum discussion created successfully!');
    }

    public function storeComment(Request $request, Forum $forum)
    {
        if (auth()->user()->is_banned) {
            return back()->with('error', 'Your account has been banned from commenting in the forum.');
        }
        
        $validated = $request->validate([
            'content' => 'required'
        ]);

        $forum->comments()->create([
            'content' => $validated['content'],
            'user_id' => auth()->id()
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    public function updateComment(Request $request, ForumComment $comment)
    {
        // Authorize that only comment owner can edit
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'content' => 'required'
        ]);

        $comment->update($validated);

        return back()->with('success', 'Comment updated successfully!');
    }

    public function destroyComment(ForumComment $comment)
    {
        // Authorize that only comment owner can delete
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
} 