<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\SubCategory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catgory_one = Category::updateOrCreate(['category_name' => 'Men', 'category_slug' => 'men']);
        $catgory_two = Category::updateOrCreate(['category_name' => 'Women', 'category_slug' => 'women']);
        $catgory_three = Category::updateOrCreate(['category_name' => 'Phone', 'category_slug' => 'phone']);

        //category of Men 
        SubCategory::updateOrCreate([
            'category_id' => $catgory_one->id,
            'sub_category_name' => 'Shirt',
            'sub_category_slug' => 'shirt',
        ]);

        SubCategory::updateOrCreate([
            'category_id' => $catgory_one->id,
            'sub_category_name' => 'Pant',
            'sub_category_slug' => 'pant',
        ]);

        SubCategory::updateOrCreate([
            'category_id' => $catgory_one->id,
            'sub_category_name' => 'Watch',
            'sub_category_slug' => 'watch',
        ]);

        //women category sub category
        SubCategory::updateOrCreate([
            'category_id' => $catgory_two->id,
            'sub_category_name' => 'Three Pis',
            'sub_category_slug' => 'three-pis',
        ]);

        SubCategory::updateOrCreate([
            'category_id' => $catgory_two->id,
            'sub_category_name' => 'Cosmetics',
            'sub_category_slug' => 'cosmetics',
        ]);

        //phone category sub category
        SubCategory::updateOrCreate([
            'category_id' => $catgory_three->id,
            'sub_category_name' => 'Vivo',
            'sub_category_slug' => 'vivo',
        ]);
    }
}
