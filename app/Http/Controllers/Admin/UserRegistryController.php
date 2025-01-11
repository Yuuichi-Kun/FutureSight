<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserRegistryController extends Controller
{
    public function getRegistryData() {
        
        $users = User::whereType('0')->get();

    // Data Dates
    $dates = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    // Manipulasi registeredUsers
    $registeredUsers = array_fill(0, 7, 0);

    foreach ($users as $user) {
        // Ambil hari dari created_at dan hitung jumlah user aktif di tiap hari
        $dayIndex = Carbon::parse($user->created_at)->dayOfWeek;
        $registeredUsers[$dayIndex]++;

    }

    // Format JSON yang diinginkan
    $response = [
        'dates' => $dates,
        'registeredUsers' => $registeredUsers,
    ];
    return response()->json($response);

    }
}
