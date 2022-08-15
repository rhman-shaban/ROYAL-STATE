<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aminity extends Model
{
    protected $fillable=[
        'aminity','icon','status','slug'
    ];



    public function propertyAminities(){
        return $this->hasMany(PropertyAminity::class);
    }
}
