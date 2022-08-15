<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Mail\UserVerification;
use Str;
use Mail;
use App\Rules\Captcha;
use App\Setting;
use App\BannerImage;
use App\Navigation;
use App\ManageText;
use App\EmailTemplate;
use App\ValidationText;
use App\NotificationText;
use App\Helpers\MailHelper;
class RegisterController extends Controller
{


    use RegistersUsers;


    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:web');
    }


    public function userRegisterPage(){
        return redirect()->to('/invalid');
    }

    public function storeRegister(Request $request){
        $valid_lang=ValidationText::all();
        $rules = [
            'name'=>'required|unique:users',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:3',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'name.unique' => $valid_lang->where('lang_key','unique_name')->first()->custom_text,
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
            'email.unique' => $valid_lang->where('lang_key','unique_email')->first()->custom_text,
            'password.required' => $valid_lang->where('lang_key','pass')->first()->custom_text,
            'password.min' => $valid_lang->where('lang_key','min_pass')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $user=User::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'email_verified_token'=>Str::random(100)
        ]);

        MailHelper::setMailConfig();

        $template=EmailTemplate::where('id',5)->first();
        $message=$template->description;
        $subject=$template->subject;
        $message=str_replace('{{user_name}}',$user->name,$message);

        Mail::to($user->email)->send(new UserVerification($user,$message,$subject));

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','register')->first()->custom_text;
        return response()->json(['success'=>$notification]);

    }

    public function userVerify($token){
        $user=User::where('email_verified_token',$token)->first();
        $notify=NotificationText::first();
        if($user){
            $user->email_verified_token=null;
            $user->status=1;
            $user->email_verified=1;
            $user->save();
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','verified')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return  redirect()->route('login')->with($notification);
        }else{

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','invalid_token')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('register')->with($notification);
        }
    }
}
