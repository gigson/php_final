<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        "text"
    ];

    public function comments(){
        return $this->belongsTo("App\Product", "product_id");
    }

    public function user(){
        return $this->hasOne("App\User", "id", "user_id");
    }
}
