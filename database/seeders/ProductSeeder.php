<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::updateOrCreate([
            'brand_id' => 1, 
            'category_id' => 1, 
            'subcategory_id' => 1, 
            'user_id' => 1, 
            'product_name' => 'Mi Router', 
            'product_slug' => 'mi-router', 
            'product_code' => 'bd-440', 
            'product_qty' => 5, 
            'product_tags' => 'mi,router', 
            'product_size' => 'm,l,xl', 
            'product_color' => 'red,white,black', 
            'selling_price' => 1000, 
            'discount_price' => 900, 
            'product_thumbnail' => 'uploads/products/thumbnail/default.jpg', 
            'short_description' => 'This is short description of product', 
            'long_description' => 'This is the long description of the product', 
            'key_features' => '1 year warenty', 
            'specifications' => 'best battery', 
        ]);

        Product::updateOrCreate([
            'brand_id' => 1, 
            'category_id' => 1, 
            'subcategory_id' => 1, 
            'user_id' => 1, 
            'product_name' => 'Note 7', 
            'product_slug' => 'note-7', 
            'product_code' => 'bd-450', 
            'product_qty' => 5, 
            'product_tags' => 'note,mi', 
            'product_size' => 'm,l,xl', 
            'product_color' => 'red,white,black', 
            'selling_price' => 2000, 
            'discount_price' => 1800, 
            'product_thumbnail' => 'uploads/products/thumbnail/default.jpg', 
            'short_description' => 'This is short description of product', 
            'long_description' => 'This is the long description of the product', 
            'key_features' => '1 year warenty', 
            'specifications' => 'best display', 
        ]);
    }
}
