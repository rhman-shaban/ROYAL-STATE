<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReCaptcha\ReCaptcha;
use App\Setting;
use App\ValidationText;
class Captcha implements Rule
{

    public $errorTexts;
    public function __construct()
    {
        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $setting=Setting::first();
        $recaptcha=new ReCaptcha($setting->captcha_secret);
        $response=$recaptcha->verify($value, $_SERVER['REMOTE_ADDR']);
        return $response->isSuccess();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $errorTexts=ValidationText::all();
        return $errorTexts->where('lang_key','recaptcha')->first()->custom_text;
    }
}
