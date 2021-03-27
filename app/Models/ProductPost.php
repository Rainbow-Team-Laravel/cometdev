<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPost extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function productCategories(){
        return $this->belongsToMany('App\Models\ProductCategory');
    }
}
