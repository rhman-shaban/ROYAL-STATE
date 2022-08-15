<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriberEmail extends Model
{
    protected $fillable=[
        'subject','message'
    ];
}
