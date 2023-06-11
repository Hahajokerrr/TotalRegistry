<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    // return statistics page
    public function userStatistics()
    {
        return inertia('Statistics/UserStatistics');
    }

    // fetch chart data
    public function countListingsByMonth($year, Request $request)
    {
        // $year = ('year', date('Y'));

        $labels = [];
        $data = [];
        $userId = $request->user()->id;
        for ($month = 1; $month <= 12; $month++) {
            $count = Listing::where('by_user_id', $userId)->whereYear('inspection_date', $year)
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

    // fetch chart data
    public function countListingsByQuarter($year, Request $request)
    {
        $labels = [];
        $data = [];
        $userId = $request->user()->id;

        for ($quarter = 1; $quarter <= 4; $quarter++) {
            $startMonth = ($quarter - 1) * 3 + 1;
            $endMonth = $quarter * 3;

            $count = Listing::where('by_user_id', $userId)
                ->whereYear('inspection_date', $year)
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

    // fetch chart data
    public function countListingsByYear(Request $request)
    {
        $labels = [];
        $data = [];
        $userId = $request->user()->id;

        $years = Listing::selectRaw('YEAR(inspection_date) as year')
            ->groupBy('year')
            ->pluck('year');

        foreach ($years as $year) {
            $count = Listing::where('by_user_id', $userId)
            ->whereYear('inspection_date', $year)
                ->count();

            $labels[] = $year;
            $data[] = $count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function countExpiringListings(Request $request)
    {
        $labels = [];
        $data = [];
        $userId = $request->user()->id;

        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(30);
        $total = 0;

        while ($startDate <= $endDate) {
            $count = Listing::where('by_user_id', $userId)
            ->whereDate('expiration_date', $startDate)->count();
            $labels[] = $startDate->format('d/m');
            $data[] = $count;
            $total += $count;
            $startDate->addDay();
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'total' => $total,
        ]);
    }

    // cars that were registered in current user's province and not yet inspected
    public function countRegisteredCars(Request $request)
    {
        $province = $request->user()->province_id;
        $countUnlistedCars = \App\Models\Car::where('province_id', $province)->whereDoesntHave('listing')->count();
        return response()->json([
            'count' => $countUnlistedCars
        ]);
    }
}
