<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable=[
        'header','description','show_homepage','section_name','content_quantity','icon'
    ];
}
