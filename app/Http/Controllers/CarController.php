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

}
