<?php

namespace App\Http\Controllers\Staff\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use Hash;
use App\BannerImage;
use App\ValidationText;
use App\NotificationText;
use App\ManageText;
class StaffLoginController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::STAFF;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:staff')->except('staffLogout');
    }


    public function staffLoginForm(){
        $image=BannerImage::find(8);
        $websiteLang=ManageText::all();
        return view('staff.auth.login',compact('image','websiteLang'));
    }

    public function storeLoginInfo(Request $request){

        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required|email',
            'password'=>'required',
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

        $notify=NotificationText::all();
        $isAdmin=Admin::where('email',$request->email)->first();
        if($isAdmin){
            if($isAdmin->status==1){
                if($isAdmin->admin_type==2){
                    if(Hash::check($request->password,$isAdmin->password)){
                        if(Auth::guard('staff')->attempt($credential,$request->remember)){
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

    public function staffLogout(){
        Auth::guard('staff')->logout();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','logout')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('staff.login')->with($notification);
    }

}
