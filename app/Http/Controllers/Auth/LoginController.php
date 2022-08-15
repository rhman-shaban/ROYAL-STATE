<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use App\Rules\Captcha;
use App\Setting;
use App\BannerImage;
use App\Navigation;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;



class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:web')->except('userLogout');
    }

    public function userLoginPage(){
        $banner_image=BannerImage::find(11);
        $setting=Setting::first();
        $menus=Navigation::all();
        $allowLogin=$menus->where('id',12)->first();
        if($allowLogin->status!=1){
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('home')->with($notification);
        }

        $websiteLang=ManageText::all();
        return view('auth.login',compact('banner_image','setting','menus','websiteLang'));
    }

    public function storeLogin(Request $request){
        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required',
            'password'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
            'password.required' => $valid_lang->where('lang_key','pass')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $credential=[
            'email'=> $request->email,
            'password'=> $request->password
        ];

        $user=User::where('email',$request->email)->first();
        if($user){
            if($user->status==1){
                if(Hash::check($request->password,$user->password)){
                    if(Auth::guard('web')->attempt($credential,$request->remember)){
                        $notify_lang=NotificationText::all();
                        $notification=$notify_lang->where('lang_key','login')->first()->custom_text;

                        return response()->json(['success'=>$notification]);
                    }
                }else{
                    $notify_lang=NotificationText::all();
                    $notification=$notify_lang->where('lang_key','invalid_login')->first()->custom_text;

                    return response()->json(['error'=>$notification]);
                }

            }else{
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','inactive_user')->first()->custom_text;

                return response()->json(['error'=>$notification]);
            }
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','email_not_exist')->first()->custom_text;
            return response()->json(['error'=>$notification]);
        }
    }

    public function userLogout(){
        Auth::guard('web')->logout();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','logout')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return Redirect()->route('login')->with($notification);
    }
}
