<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $dashboardService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DashboardService $dashboardService)
    {
        $this->middleware('auth');
        $this->dashboardService = $dashboardService;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dashboardData = [
            'totalSession' => $this->dashboardService->getTotalSessions(),
            'lastSession' => $this->dashboardService->getLastSession()
        ];


        return view('home')->with([
            'dashboardData' => json_encode($dashboardData)
        ]);
    }
}
