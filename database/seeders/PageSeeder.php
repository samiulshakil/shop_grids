<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'name' => 'About',
            'slug' => 'about',
            'short_description' => 'This is page description',
            'body' => 'This is the body of about page',
            'meta_description' => 'about des',
            'meta_keyword' => 'about',
            'status' => true,
        ]);
    }
}
