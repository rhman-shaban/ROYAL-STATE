<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModalConsent extends Model
{
    protected $fillable=[
        'status','border','corners','background_color','text_color','border_color','btn_bg_color','btn_text_color','message','link_text','btn_text','link',
    ];
}
