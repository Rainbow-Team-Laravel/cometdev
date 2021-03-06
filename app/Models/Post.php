<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    //to create ineter relationship between category and post (many to many relationship)

    public function categories(){
        return $this->belongsToMany('App\Models\Category');
    }

    public function author(){
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }









}
