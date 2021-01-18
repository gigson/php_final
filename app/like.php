<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    protected $fillable = [
        'user_id',
        'product_id'
    ];

    public function likes(){
        return $this->belongsTo("App\Product", "product_id");
    }
}
