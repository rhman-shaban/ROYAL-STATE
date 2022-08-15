<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable=[
        'user_id','property_id'
    ];

    public function property(){
        return $this->belongsTo(Property::class);
    }
}
