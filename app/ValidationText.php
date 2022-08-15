<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValidationText extends Model
{
    protected $fillable=[
        'default_text','custom_text'
    ];
}
