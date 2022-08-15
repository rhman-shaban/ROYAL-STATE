<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyNearestLocation extends Model
{
    public function nearestLocation(){
        return $this->belongsTo(NearestLocation::class);
    }
}
