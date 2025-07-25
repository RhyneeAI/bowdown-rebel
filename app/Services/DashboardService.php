<?php
namespace App\Services;
use App\Models\User;
use App\Models\Product;
use App\Models\Checkout;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getDashboardData()
    {
        return [
            'userCount' => User::where('id_role', 2)->count(),
            'productCount' => Product::count(),
            'orderCount' => Checkout::count(),
            'totalRevenue' => Checkout::sum('dibayar'),
        ];
    }

    public function getMonthlyRevenue()
    {
        $monthlyRevenue = DB::table('checkout')
            ->selectRaw("MONTH(created_at) as month, SUM(dibayar) as total")
            ->groupByRaw("MONTH(created_at)")
            ->orderByRaw("MONTH(created_at)")
            ->pluck('total', 'month');

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $monthlyRevenue[$i] ?? 0; // Jika bulan tidak ada, isi 0
        }

        return $data;
    }
}