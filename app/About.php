<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable=[
        'icon','header','header_description','description','background_image','video_link'
    ];
}
