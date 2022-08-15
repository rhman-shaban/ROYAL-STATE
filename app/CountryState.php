<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryState extends Model
{
    protected $fillable=[
        'country_id','name','slug','status'
    ];


    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function cities(){
        return $this->hasMany(City::class);
    }

}
