<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Http;

class GetCarController extends Controller
{
  public function index()
  {
    $makes = [
      "Audi",
      "Honda",
      "Hyundai",
      "Kia",
      "Toyota",
    ];

    $apiKey = env('API_NINJAS_KEY');
    $vehicles = [];
    $carCount = 0;

    foreach ($makes as $make) {
      $response = Http::withHeaders([
        'X-Api-Key' => $apiKey,
      ])->get("https://api.api-ninjas.com/v1/cars?limit=15&make={$make}&year=2023");

      if ($response->successful()) {
        $data = $response->json();

        foreach ($data as $car) {
          $modelYear = $car['model'] . $car['year'];
          if (!isset($vehicles[$modelYear]) && $carCount < 60) {
            $randomColor = $this->getRandomColor();
            $randomPrice = $this->getRandomPrice();
            $randomPopularity = $this->getRandomPopularity();
            $brandId = $this->getBrandByMake(ucfirst(strtolower($car['make'])));

            if ($brandId !== null) {
              $existingCar = Car::where('model', $car['model'])
                ->where('year', $car['year'])
                ->where('brand_id', $brandId)
                ->first();

              if (!$existingCar) {
                $vehicles[$modelYear] = [
                  'model' => $car['model'],
                  'year' => $car['year'],
                  'brand_id' => $brandId,
                  'color' => $randomColor,
                  'price_per_day' => $randomPrice,
                  'popularity' => $randomPopularity,
                ];

                $carCount++;
              }
            }
          }

          if ($carCount >= 59) {
            break;
          }
        }
      }
    }

    foreach ($vehicles as $vehicle) {
      Car::create($vehicle);
    }
    // return response()->json(array_values($vehicles));
    return response()->json(count($vehicles));
  }

  private function getBrandByMake($make)
  {
    $brandMapping = [
      "Audi" => 1,
      "Honda" => 2,
      "Hyundai" => 3,
      "Kia" => 4,
      "Toyota" => 5,
    ];

    return $brandMapping[$make] ?? null;
  }

  private function getRandomColor()
  {
    $colors = ['red', 'blue', 'green', 'yellow', 'black', 'white', 'silver', 'gray', 'purple', 'orange'];
    return $colors[array_rand($colors)];
  }

  private function getRandomPrice()
  {
    return round(rand(5000, 20000) / 100, 2);
  }

  private function getRandomPopularity()
  {
    return rand(1, 5);
  }
}
