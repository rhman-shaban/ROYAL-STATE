<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    protected $fillable=[
        'property_id','image'
    ];
}
