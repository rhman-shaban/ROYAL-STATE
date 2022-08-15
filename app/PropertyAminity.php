<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyAminity extends Model
{
    protected $fillable=[
        'property_id','aminity_id','status'
    ];

    public function aminity(){
        return $this->belongsTo(Aminity::class);
    }

    public function property(){
        return $this->belongsTo(Property::class);
    }


}
