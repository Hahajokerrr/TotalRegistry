<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Listing::class, 'listing');
    // }

    public function userStatistics()
    {
        return inertia('Statistics/UserStatistics');
    }

    public function countListingsByMonth($year)
    {
        // $year = ('year', date('Y'));

        $labels = [];
        $data = [];

        for ($month = 1; $month <= 12; $month++) {
            $count = Listing::whereYear('inspection_date', $year)
                ->whereMonth('inspection_date', $month)
                ->count();

            $labels[] = "Tháng " . $month;
            $data[] = $count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function countListingsByQuarter($year)
    {
        $labels = [];
        $data = [];

        for ($quarter = 1; $quarter <= 4; $quarter++) {
            $startMonth = ($quarter - 1) * 3 + 1;
            $endMonth = $quarter * 3;

            $count = Listing::whereYear('inspection_date', $year)
                ->whereMonth('inspection_date', '>=', $startMonth)
                ->whereMonth('inspection_date', '<=', $endMonth)
                ->count();

            $labels[] = "Quý " . $quarter;
            $data[] = $count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function countListingsByYear()
    {
        $labels = [];
        $data = [];

        $years = Listing::selectRaw('YEAR(inspection_date) as year')
            ->groupBy('year')
            ->pluck('year');

        foreach ($years as $year) {
            $count = Listing::whereYear('inspection_date', $year)
                ->count();

            $labels[] = $year;
            $data[] = $count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
