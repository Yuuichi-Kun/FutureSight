<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Alumni;
use App\Models\TracerKerja;
use App\Models\TracerKuliah;
use App\Models\Testimoni;
use App\Models\Forum;
use App\Models\User;
use App\Models\Message;

class AdminController extends Controller
{
    public function dashboardAdmin()
    {
        // Hitung statistik untuk dashboard
        $totalAlumni = Alumni::count();
        $totalBekerja = TracerKerja::count();
        $totalKuliah = TracerKuliah::count();
        $responseRate = ($totalAlumni > 0) ? 
            round((($totalBekerja + $totalKuliah) / $totalAlumni) * 100) : 0;

        // Tambahkan data untuk komponen baru
        $latestTestimonials = Testimoni::with('alumni')
            ->latest('tgl_testimoni')
            ->take(5)
            ->get();

        $latestAlumni = Alumni::with(['statusAlumni', 'tahunLulus'])
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('admin.adminHome', compact(
            'totalAlumni',
            'totalBekerja',
            'totalKuliah',
            'responseRate',
            'latestTestimonials',
            'latestAlumni'
        ));
    }

    public function profileAdmin(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function alumniIndex()
    {
        $alumni = Alumni::with(['tahunLulus', 'konsentrasiKeahlian', 'statusAlumni'])
            ->orderBy('nama_depan')
            ->paginate(10);
        
        return view('admin.alumni.index', compact('alumni'));
    }

    public function alumniShow(Alumni $alumni)
    {
        // Pengecekan apakah alumni memiliki relasi user
        if (!$alumni->user) {
            return redirect()->route('admin.alumni.index')
                ->with('error', 'Data user alumni tidak ditemukan.');
        }

        $alumni->load([
            'user',  // Tambahkan eager loading untuk user
            'tracerKerja',
            'tracerKuliah',
            'testimoni',
            'tahunLulus',
            'konsentrasiKeahlian',
            'statusAlumni'
        ]);
        
        return view('admin.alumni.show', compact('alumni'));
    }

    public function forumMonitoring()
    {
        $forumActivities = Forum::with(['user', 'comments.user'])
            ->latest()
            ->paginate(10);

        return view('admin.forum.monitoring', compact('forumActivities'));
    }

    public function warnUser(User $user)
    {
        // Increment warning count
        $user->update(['warning_count' => $user->warning_count + 1]);
        
        // Create warning message
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'content' => "WARNING: You have received a warning from the administrator for inappropriate behavior in the forum. Continued violations may result in account suspension.",
            'is_system_message' => true
        ]);
        
        return back()->with('success', 'Warning has been sent to the user.');
    }

    public function banUser(User $user)
    {
        // Ban user
        $user->update(['is_banned' => true]);
        
        // Create ban notification message
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'content' => "Your account has been banned due to violations of our community guidelines. If you believe this is a mistake, please contact the administrator.",
            'is_system_message' => true
        ]);
        
        return back()->with('success', 'User has been banned from the forum.');
    }

    public function unbanUser(User $user)
    {
        // Unban user
        $user->update(['is_banned' => false]);
        
        // Create unban notification message
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'content' => "Your account has been unbanned. You can now participate in forum discussions again. Please make sure to follow our community guidelines.",
            'is_system_message' => true
        ]);
        
        return back()->with('success', 'User has been unbanned from the forum.');
    }
}


