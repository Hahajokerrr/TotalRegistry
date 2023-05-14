<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarController extends Controller
{
    public function search(Request $request)
    {
        $registrationNo = $request->route('registrationNo');
        $cars = Car::where('registration_no', 'like', '%' . $registrationNo . '%')->get();
        return response()->json($cars);
    }

    public function show($registrationNo)
    {
        $car = Car::where('registration_no', 'like', $registrationNo)->first();
        $car->load(['owner', 'series.brand', 'series.country', 'province']);
        return response()->json($car);
    }

}
