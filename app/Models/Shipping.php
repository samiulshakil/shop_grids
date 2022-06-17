<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function district()
    {
        return $this->belongsTo(Location::class, 'district_id', 'id');
    }
    public function upazila()
    {
        return $this->belongsTo(Location::class, 'upazila_id', 'id');
    }
}
