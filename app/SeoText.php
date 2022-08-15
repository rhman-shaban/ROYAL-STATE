<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeoText extends Model
{
    protected $fillable=[
        'page_name','title','meta_description'
    ];
}
