<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    protected $fillable=[
        'type','status','slug'
    ];


    public function properties(){
        return $this->hasMany(Property::class);
    }
}
