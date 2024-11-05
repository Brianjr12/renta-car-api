<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\CarRequest;

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

    public function createCar(CarRequest $request)
    {
        $validatedData = $request->validated();
        $car = Car::create($validatedData);

        return response()->json($car, 201);
    }

    public function update(CarRequest $request)
    {
        $car = Car::find($request->id);
        if ($car) {
            $car->update($request->all());
            return response()->json($car);
        } else {
            return response()->json(['message' => 'Car not found'], 404);
        }
    }

    public function destroy(CarRequest $request)
    {
        $car = Car::find($request->id);
        if ($car) {
            $car->update(["availability" => false]);
            return response()->json(['message' => 'Car deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Car not found'], 404);
        }
    }
}
