<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NearestLocation extends Model
{
    protected $fillable=[
        'status','location','slug'
    ];


    public function locations(){
        return $this->hasMany(PropertyNearestLocation::class);
    }
}
