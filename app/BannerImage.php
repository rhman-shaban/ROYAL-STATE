<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    protected $fillable=[
        'image_type','location','image'
    ];
}
