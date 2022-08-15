<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable=[
        'logo','email','show','save_contact_message','comment_type','favicon','patient_can_register','facebook_comment_script','preloader','preloader_image','allow_cookie_consent','cookie_text','cookie_button_text','captcha_key','allow_captcha','captcha_secret','live_chat','livechat_script',
        'text_direction','currency_icon','currency_name','timezone','google_analytic','google_analytic_code','theme_one','theme_two','google_map_api_key'
    ];
}
