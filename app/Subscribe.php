<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $fillable=[
        'email','verify_token','status'
    ];
}
