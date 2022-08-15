<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyPurpose extends Model
{
    protected $fillable=[
        'purpose','status','slug'
    ];
}
