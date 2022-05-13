<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Brand::updateOrCreate(['brand_name' => 'Samsung', 'brand_slug' => 'samsung']);
        Brand::updateOrCreate(['brand_name' => 'Vivo', 'brand_slug' => 'vivo']);
        Brand::updateOrCreate(['brand_name' => 'Lenevo', 'brand_slug' => 'lenevo']);
    }
}
