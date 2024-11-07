<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use App\Http\Requests\BookingRequest;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(BookingRequest $request)
    {
        $car = Car::find($request->car_id);
        if (!$car) {
            return response()->json(['error' => 'Car not found'], 404);
        }

        if ($car->availability === 0) {
            return response()->json(['error' => 'Car is not available'], 400);
        }

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'car_id' => $request->car_id,
            'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
            'end_date' => Carbon::parse($request->end_date)->format('Y-m-d'),
            'total_price' => $request->total_price,
        ]);

        $car->update(["availability" => 0]);

        return response()->json(['message' => 'Booking created successfully', 'data' => $booking], 201);
    }

    public function index() {
        $bookings = Booking::where('user_id', auth()->id())->get();
        return response()->json(['message' => 'Bookings retrieved successfully', 'data' => $bookings]);
    }

    public function show($id) {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }
        return response()->json(['message' => 'Booking retrieved successfully', 'data' => $booking]);
    }

    public function cancel($id) {
        $booking = Booking::find($id);
        $car = Car::find($booking->car_id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }
        $booking->update(["status" => "cancelled"]);
        $car->update(["availability" => 1]);
        return response()->json(['message' => 'Booking cancelled successfully'],200);
    }
}
