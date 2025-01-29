<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForumPost;
use App\Models\ForumComment;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumMonitoringController extends Controller
{
    public function clearActivities()
    {
        // Delete all forum comments first to maintain referential integrity
        ForumComment::query()->delete();
        
        // Then delete all forums (not ForumPost)
        Forum::query()->delete();
        
        return redirect()->back()->with('success', 'Forum activities have been cleared successfully.');
    }
} 