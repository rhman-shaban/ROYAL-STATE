<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    protected $fillable=[
        'header','description','phones','emails','address','about','map_embed_code','copyright'
    ];
}
