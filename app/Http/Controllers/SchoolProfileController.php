<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolProfileController extends Controller
{
    public function index()
    {
        $school = School::first();
        return view('users.school-profile', compact('school'));
    }
}