<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailConfiguration extends Model
{
    protected $fillable=[
    'mail_type','mail_host','mail_port','email','email_password','smtp_username','smtp_password','mail_encryption',
    ];
}
