<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    //to create ineter relationship between category and post (many to many relationship)
    public function posts(){
        return $this->belongsToMany('App\Models\Post');
    }
}
