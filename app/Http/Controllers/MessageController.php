<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('receiver_id', auth()->id())
            ->with('sender')
            ->latest()
            ->paginate(10);
            
        return view('messages.index', compact('messages'));
    }

    public function show(User $user)
    {
        $messages = Message::where(function($query) use ($user) {
                $query->where('sender_id', auth()->id())
                      ->where('receiver_id', $user->id);
            })->orWhere(function($query) use ($user) {
                $query->where('sender_id', $user->id)
                      ->where('receiver_id', auth()->id());
            })
            ->with(['sender', 'receiver'])
            ->latest()
            ->get();

        // Mark messages as read
        Message::where('receiver_id', auth()->id())
            ->where('sender_id', $user->id)
            ->update(['is_read' => true]);

        return view('messages.show', compact('messages', 'user'));
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'content' => 'required|max:1000'
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'content' => $validated['content']
        ]);

        return back()->with('success', 'Message sent successfully!');
    }

    public function getUnreadCount()
    {
        return Message::where('receiver_id', auth()->id())
            ->where('is_read', false)
            ->count();
    }

    public function adminIndex()
    {
        $messages = Message::where('receiver_id', auth()->id())
            ->with(['sender.alumni.tahunLulus'])
            ->latest()
            ->paginate(10);
            
        return view('admin.messages.index', compact('messages'));
    }

    public function adminShow(User $user)
    {
        $messages = Message::where(function($query) use ($user) {
                $query->where('sender_id', auth()->id())
                      ->where('receiver_id', $user->id);
            })->orWhere(function($query) use ($user) {
                $query->where('sender_id', $user->id)
                      ->where('receiver_id', auth()->id());
            })
            ->with(['sender.alumni.tahunLulus'])
            ->latest()
            ->get();

        // Mark messages as read
        Message::where('receiver_id', auth()->id())
            ->where('sender_id', $user->id)
            ->update(['is_read' => true]);

        return view('admin.messages.show', compact('messages', 'user'));
    }

    public function adminStore(Request $request, User $user)
    {
        $validated = $request->validate([
            'content' => 'required|max:1000'
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'content' => $validated['content']
        ]);

        return back()->with('success', 'Message sent successfully!');
    }
} 