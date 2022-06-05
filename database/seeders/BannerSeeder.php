<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banner::updateOrCreate([
            'banner_image' => 'https://via.placeholder.com/800x500',
            'banner_image_two' => 'https://via.placeholder.com/370x250',
            'banner_title' => 'M75 Sport Watch',
            'banner_sub_title' => 'No restocking fee ($35 savings)',
            'banner_description' => 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.',
            'banner_price' => 320,
            'banner_button_text' => 'Shop Now',
        ]);

        Banner::updateOrCreate([
            'banner_image' => 'https://via.placeholder.com/800x500',
            'banner_image_two' => 'https://via.placeholder.com/370x250',
            'banner_title' => 'M75 Sport Watch',
            'banner_sub_title' => 'No restocking fee ($35 savings)',
            'banner_description' => 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.',
            'banner_price' => 620,
            'banner_button_text' => 'Shop Now',
        ]);

        Banner::updateOrCreate([
            'banner_image' => 'https://via.placeholder.com/800x500',
            'banner_image_two' => 'https://via.placeholder.com/370x250',
            'banner_title' => 'M75 Sport Watch',
            'banner_sub_title' => 'No restocking fee ($35 savings)',
            'banner_description' => 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.',
            'banner_price' => 820,
            'banner_button_text' => 'Shop Now',
        ]);
    }
}
