<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use App\Doctor;
use App\Admin;
use App\Mail\ForgetPassword;
use App\Mail\AdminForgetPassword;
use Str;
use Mail;
use Hash;
use Auth;
use App\BannerImage;
use App\EmailTemplate;
use App\NotificationText;
use App\ValidationText;
use App\ManageText;
use App\Helpers\MailHelper;
class AdminForgotPasswordController extends Controller
{
   public function forgetPassword(){
        $image=BannerImage::find(7);
        $websiteLang=ManageText::all();
       return view('admin.auth.forget-password',compact('image','websiteLang'));
   }

   public function sendForgetEmail(Request $request){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $errorTexts=ValidationText::all();
        $rules = [
            'email'=>'required'
        ];

        $customMessages = [
            'email.required' => $errorTexts->where('id',1)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $notify=NotificationText::all();

        MailHelper::setMailConfig();
        $admin=Admin::where('email',$request->email)->first();
        if($admin){
            $admin->forget_password_token=Str::random(100);
            $admin->save();

            $template=EmailTemplate::where('id',1)->first();
            $message=$template->description;
            $subject=$template->subject;
            $message=str_replace('{{name}}',$admin->name,$message);

            Mail::to($admin->email)->send(new AdminForgetPassword($admin,$message,$subject));

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','forget_pass')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return back()->with($notification);

        }else {
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','email_not_exist')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return Redirect()->back()->with($notification);
        }

   }

   public function resetPassword($token){

    // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        $admin=Admin::where('forget_password_token',$token)->first();
        $notify=NotificationText::all();
        $websiteLang=ManageText::all();
        if($admin){

            $image=BannerImage::find(7);
            return view('admin.auth.reset-password',compact('admin','token','image','websiteLang'));
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','invalid_token')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return Redirect()->route('admin.forget.password')->with($notification);
        }
   }


   public function storeResetData(Request $request,$token){

    // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $errorTexts=ValidationText::all();
        $rules = [
            'email'=>'required',
            'password'=>'required|confirmed|min:3'
        ];

        $customMessages = [
            'email.required' => $errorTexts->where('id',1)->first()->custom_text,
            'password.required' => $errorTexts->where('id',12)->first()->custom_text,
            'password.confirmed' => $errorTexts->where('id',14)->first()->custom_text,
            'password.min' => $errorTexts->where('id',35)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);


        $notify=NotificationText::all();

        $admin=Admin::where('forget_password_token',$token)->first();
        if($admin->email==$request->email){
            $admin->password=Hash::make($request->password);
            $admin->forget_password_token=null;
            $admin->save();

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','reset_pass')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return Redirect()->route('admin.login')->with($notification);

        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','email_not_exist')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return back()->with($notification);
        }
   }


}
