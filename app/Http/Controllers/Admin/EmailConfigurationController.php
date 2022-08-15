<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\EmailConfiguration;

class EmailConfigurationController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $websiteLang=ManageText::all();
        $email=EmailConfiguration::first();
        return view('admin.email-configuration.index',compact('email','websiteLang'));
    }

    public function update(Request $request){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required',
            'mail_host'=>'required',
            'mail_port'=>'required',
            'mail_encryption'=>'required',
            'smtp_username'=>'required',
            'smtp_password'=>'required',

        ];
        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
            'mail_host.required' => $valid_lang->where('lang_key','mail_host')->first()->custom_text,
            'mail_port.required' => $valid_lang->where('lang_key','mail_port')->first()->custom_text,
            'mail_encryption.required' => $valid_lang->where('lang_key','mail_encryption')->first()->custom_text,
            'smtp_username.required' => $valid_lang->where('lang_key','smtp_user')->first()->custom_text,
            'smtp_password.required' => $valid_lang->where('lang_key','smtp_pass')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $email=EmailConfiguration::first();
        $email->email=$request->email;
        $email->mail_host=$request->mail_host;
        $email->mail_port=$request->mail_port;
        $email->smtp_username=$request->smtp_username;
        $email->smtp_password=$request->smtp_password;
        $email->mail_encryption=$request->mail_encryption;
        $email->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.email-configuration')->with($notification);

    }
}
