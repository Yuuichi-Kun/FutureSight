<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function profileUser(Request $request): View
    {
        return view('profileUser.edit', [
            'user' => $request->user(),
        ]);
    }

    public function tabPilihan(): View
    {
        return view('users.tab-pilihan');
    }
}
