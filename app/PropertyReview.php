<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyReview extends Model
{
    protected $fillable=[
    'user_id','property_id','comment','rating','status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }


}
