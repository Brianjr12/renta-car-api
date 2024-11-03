<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Http;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return response()->json($cars);
    }

    public function carById($id)
    {
        $car = Car::find($id);

        error_log($id);

        if ($car) {
            return response()->json($car);
        } else {
            return response()->json(['message' => 'Car not found'], 404);
        }
    }

}
