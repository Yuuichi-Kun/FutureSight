<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class UserController extends Controller
{
    public function profileUser(Request $request): View
    {
        return view('profileUser.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Show the profile of another user
     *
     * @param User $user
     * @return View
     */
    public function showProfile(User $user): View
    {
        $profileUser = $user;  // Rename to avoid confusion in the view
        return view('users.profile', compact('profileUser'));
    }
}
