<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    protected $fillable=[
        'paypal_client_id','paypal_secret','stripe_key','stripe_secret','captcha_key','captcha_secret','account_mode','bank_account'
    ];
}
