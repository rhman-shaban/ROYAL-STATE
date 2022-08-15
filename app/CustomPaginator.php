<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomPaginator extends Model
{
    protected $fillable=[
        'page','qty'
    ];
}
