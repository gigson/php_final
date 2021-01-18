<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'title',
        'price',
        'description',
        'image'
    ];

    public function categories(){
        return $this->hasMany("App\Category");
    }

    public function comments(){
        return $this->hasMany("App\Comment");
    }
}
