<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }
    public function index()
    {
        $data = $this->dashboardService->getDashboardData();
        $monthlyRevenue = $this->dashboardService->getMonthlyRevenue();
        return view('dashboard.dashboard', $data, compact('monthlyRevenue'));
    }
}
