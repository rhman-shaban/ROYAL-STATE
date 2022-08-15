<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable=[
        'subject','description','name'
    ];
}
