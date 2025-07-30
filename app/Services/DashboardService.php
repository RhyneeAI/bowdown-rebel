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


    public function getMonthlyProductCount()
    {
        $monthlyProductCount = Product::selectRaw("MONTH(created_at) as month, COUNT(*) as total")
            ->whereYear('created_at', now()->year) // hanya tahun berjalan
            ->groupByRaw("MONTH(created_at)")
            ->orderByRaw("MONTH(created_at)")
            ->pluck('total', 'month');

        // Inisialisasi array 12 bulan
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $monthlyProductCount[$i] ?? 0; // isi 0 jika tidak ada produk
        }

        return $data;
    }


    public function getDailyOrderCount()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $dailyOrderCount = DB::table('checkout')
            ->selectRaw("DAY(created_at) as day, COUNT(*) as total")
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->groupByRaw("DAY(created_at)")
            ->orderByRaw("DAY(created_at)")
            ->pluck('total', 'day');

        // Hitung jumlah hari dalam bulan sekarang
        $daysInMonth = now()->daysInMonth;

        $data = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $data[] = $dailyOrderCount[$i] ?? 0; // isi 0 jika tidak ada data
        }

        return $data;
    }
    public function getDailyUserCount()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $dailyUserCount = DB::table('user')
            ->selectRaw("DAY(created_at) as day, COUNT(*) as total")
            ->where('id_role', 2) // hanya user dengan role id 2
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->groupByRaw("DAY(created_at)")
            ->orderByRaw("DAY(created_at)")
            ->pluck('total', 'day');

        // Hitung jumlah hari dalam bulan sekarang
        $daysInMonth = now()->daysInMonth;

        $data = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $data[] = $dailyUserCount[$i] ?? 0; // isi 0 jika tidak ada data
        }

        return $data;
    }


}