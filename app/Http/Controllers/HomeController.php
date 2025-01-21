<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Testimoni;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['welcome']);
    }
  
    /**
     * Show the welcome page for guests
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome(): View
    {
        $testimonials = Testimoni::with('alumni.user')->latest('tgl_testimoni')->get();
        return view('users.home', compact('testimonials'));
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $testimonials = Testimoni::with('alumni.user')->latest('tgl_testimoni')->get();
        return view('users.home', compact('testimonials'));
    } 
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        return view('admin.adminHome');
    }
}
