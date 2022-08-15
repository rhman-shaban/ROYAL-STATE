<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConditionPrivacy extends Model
{
    protected $fillable=[
        'terms_condition','privacy_policy'
    ];
}
