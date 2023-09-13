<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\MonthHelper;


class dashboardController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $sold = [];
        $month = [];
        $recentMonths = DB::table('order_details')
            ->select(
                DB::raw('YEAR(time) as year'),
                DB::raw('MONTH(time) as month'),
                DB::raw('SUM(quantity) as total_quantity')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit(5)
            ->get();
        $recentMonths = $recentMonths->reverse();
        foreach ($recentMonths as $month) {
            $year = $month->year;
            $monthNumber = $month->month;
            $monthName = MonthHelper::getMonthName($monthNumber);
            $totalQuantity = $month->total_quantity;
            $months[] = $monthName;
            $sold[] = $totalQuantity;
        }
        return view('admin.dashboard.index', compact('sold', 'months'));
    }
}
