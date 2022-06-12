<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

        /**
         * Get all of the comments for the Category
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function subCategories()
        {
            return $this->hasMany(SubCategory::class, 'category_id', 'id');
        }

        public function products(){
            return $this->hasMany(Product::class);
        }
}
