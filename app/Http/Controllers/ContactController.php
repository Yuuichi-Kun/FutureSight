<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'name' => 'required|string|max:255'
            ]);

            // Get admin user (user with type = 1 for admin)
            $admin = User::where('type', 1)->first();

            if (!$admin) {
                \Log::error('No admin user found for contact form submission');
                return back()->with('error', 'Sistem sedang mengalami gangguan. Silakan coba lagi nanti.');
            }

            // Create a temporary user for the contact message
            $tempUser = User::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'name' => $validated['name'],
                    'password' => bcrypt(Str::random(16))
                ]
            );

            // Create message
            Message::create([
                'sender_id' => $tempUser->id,
                'receiver_id' => $admin->id,
                'content' => "Contact request from: {$validated['name']} ({$validated['email']})",
                'is_system_message' => true
            ]);

            return back()->with('success', 'Pesan Anda telah terkirim. Kami akan menghubungi Anda segera.');
        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi nanti.');
        }
    }
} 