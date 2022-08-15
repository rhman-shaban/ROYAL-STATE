<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function propertyType(){
        return $this->belongsTo(PropertyType::class);
    }

    public function propertyPurpose(){
        return $this->belongsTo(PropertyPurpose::class);
    }

    public function propertyAminities(){
        return $this->hasMany(PropertyAminity::class);
    }

    public function propertyImages(){
        return $this->hasMany(PropertyImage::class);
    }

    public function propertyNearestLocations(){
        return $this->hasMany(PropertyNearestLocation::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reviews(){
        return $this->hasMany(PropertyReview::class);
    }








}
