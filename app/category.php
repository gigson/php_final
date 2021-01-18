<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [
        'name',
        'product_id'
    ];

    public function products(){
        return $this->belongsTo("App\Product", "product_id");
    }
}
