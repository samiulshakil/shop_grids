<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\User;
use App\Models\MultiImage;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

         
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function images()
    {
     return $this->hasMany(MultiImage::class);
    }
}