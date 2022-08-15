<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $fillable=[
        'topbar_email','topbar_phone','footer_phone','footer_email','footer_address','facebook','twitter','instagram','linkedin','youtube'
    ];

}
