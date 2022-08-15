<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationText extends Model
{
    protected $fillable=[
        'login_success','login_credential','inactive_user','invalid_email','logout_success','register_confirm','successfull_verification','invalid_token','forget_password','contact_message','appointment_added','appointment_removed','fill_up_profile','payment_successfull','payment_faild','account_update','password_change','comment_success','verify_subscribe','already_subscribe','successfully_subscribe',
    ];
}
