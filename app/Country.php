<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable=[
        'name','slug','status'
    ];


    public function countryStates(){
        return $this->hasMany(CountryState::class);
    }
}
