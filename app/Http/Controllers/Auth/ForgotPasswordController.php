<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use App\Mail\ForgetPassword;
use Str;
use Mail;
use Hash;
use Auth;
use App\Rules\Captcha;
use App\Setting;
use App\BannerImage;
use App\Navigation;
use App\ManageText;
use App\EmailTemplate;
use App\NotificationText;
use App\ValidationText;
use App\Helpers\MailHelper;
class ForgotPasswordController extends Controller
{


    public function forgetPassForm(){
        $banner_image=BannerImage::find(11);
        $setting=Setting::first();
        $menus=Navigation::all();
        $websiteLang=ManageText::all();
        return view('auth.forget',compact('banner_image','setting','menus','websiteLang'));

    }
   public function sendForgetEmail(Request $request){

        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required|email',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $user=User::where('email',$request->email)->first();

        MailHelper::setMailConfig();
        if($user){
            $user->forget_password_token=Str::random(100);
            $user->save();
            $template=EmailTemplate::where('id',1)->first();
            $message=$template->description;
            $subject=$template->subject;
            $message=str_replace('{{name}}',$user->name,$message);
            Mail::to($user->email)->send(new ForgetPassword($user,$message,$subject));

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','forget_pass')->first()->custom_text;
            return response()->json(['success'=>$notification]);

        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','email_not_exist')->first()->custom_text;
            return response()->json(['error'=>$notification]);
        }

   }

   public function resetPassword($token){
        $user=User::where('forget_password_token',$token)->first();
        if($user){
            $setting=Setting::first();
            $banner_image=BannerImage::find(11);
            $websiteLang=ManageText::all();
            $menus=Navigation::all();
            return view('auth.reset-password',compact('user','token','setting','banner_image','websiteLang','menus'));
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','invalid_token')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return Redirect()->route('forget.password')->with($notification);
        }
   }


   public function storeResetData(Request $request,$token){
        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required|email',
            'password'=>'required|confirmed|min:3',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
            'password.required' => $valid_lang->where('lang_key','pass')->first()->custom_text,
            'password.confirmed' => $valid_lang->where('lang_key','confirm_pass')->first()->custom_text,
            'password.min' => $valid_lang->where('lang_key','min_pass')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $user=User::where('forget_password_token',$token)->first();
        if($user->email==$request->email){
            $user->password=Hash::make($request->password);
            $user->forget_password_token=null;
            $user->save();
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','reset_pass')->first()->custom_text;
            return response()->json(['success'=>$notification]);

        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','email_not_exist')->first()->custom_text;
            return response()->json(['error'=>$notification]);
        }
   }


}
