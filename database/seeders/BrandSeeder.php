<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            "Audi",
            "Honda",
            "Hyundai",
            "Kia",
            "Toyota",
        ];

        foreach ($brands as $brand) {
            Brand::create(['name' => $brand]);
        }
    }
}
