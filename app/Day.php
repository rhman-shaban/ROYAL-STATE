<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable=[
        'day','custom_day'
    ];

    public function schedule(){
        return $this->hasMany(ListingSchedule::class);
    }
}
