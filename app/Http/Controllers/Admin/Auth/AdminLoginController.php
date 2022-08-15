<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use Hash;
use App\BannerImage;
use App\NotificationText;
use App\ValidationText;
use App\ManageText;
class AdminLoginController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('adminLogout');
    }


    public function adminLoginForm(){
        $isAdmin=Admin::all()->count();
        $image=BannerImage::find(7);
        $websiteLang=ManageText::all();
        return view('admin.auth.login',compact('isAdmin','image','websiteLang'));
    }

    public function storeLoginInfo(Request $request){

        $errorTexts=ValidationText::all();
        $rules = [
            'email'=>'required|email',
            'password'=>'required',
        ];

        $customMessages = [
            'email.required' => $errorTexts->where('id',1)->first()->custom_text,
            'email.email' => $errorTexts->where('id',2)->first()->custom_text,
            'password.required' => $errorTexts->where('id',12)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);

        $credential=[
            'email'=> $request->email,
            'password'=> $request->password
        ];

        $isAdmin=Admin::where('email',$request->email)->first();
        if($isAdmin){
            if($isAdmin->status==1){
                if($isAdmin->admin_type==1 || $isAdmin->admin_type==0){
                    if(Hash::check($request->password,$isAdmin->password)){
                        if(Auth::guard('admin')->attempt($credential,$request->remember)){

                            $notify_lang=NotificationText::all();
                            $notification=$notify_lang->where('lang_key','login')->first()->custom_text;
                            return response()->json(['success'=>$notification]);

                        }

                        $notify_lang=NotificationText::all();
                        $notification=$notify_lang->where('lang_key','something')->first()->custom_text;

                        return response()->json(['error'=>$notification]);

                    }else{
                        $notify_lang=NotificationText::all();
                        $notification=$notify_lang->where('lang_key','invalid_login')->first()->custom_text;

                        return response()->json(['error'=>$notification]);
                    }
                }else{
                    $notify_lang=NotificationText::all();
                    $notification=$notify_lang->where('lang_key','something')->first()->custom_text;

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

    public function adminLogout(){
        Auth::guard('admin')->logout();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','logout')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.login')->with($notification);
    }


}
