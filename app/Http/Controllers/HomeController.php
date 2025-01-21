<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Testimoni;
use App\Services\AlumniStatisticService;

class HomeController extends Controller
{
    protected $statisticService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AlumniStatisticService $statisticService)
    {
        $this->middleware('auth')->except(['welcome']);
        $this->statisticService = $statisticService;
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
        $statistics = $this->statisticService->getAllStatistics();
        $testimonials = Testimoni::with('alumni.user')->latest('tgl_testimoni')->get();
        return view('users.home', [
            'statistics' => $statistics,
            'testimonials' => $testimonials
        ]);
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
