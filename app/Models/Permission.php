<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'name',
        'slug',
    ];

        /**
     * Get all the permissions
     *
     * @return mixed
     */

    public function module(){
        return $this->belongsTo(Module::class);
    } 

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
