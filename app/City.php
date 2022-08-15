<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable=[
        'country_state_id','name','slug','status'
    ];


    public function countryState(){
        return $this->belongsTo(CountryState::class);
    }

    public function properties(){
        return $this->hasMany(Property::class);
    }
}
