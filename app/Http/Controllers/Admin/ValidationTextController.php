<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ValidationText;
use App\NotificationText;
use App\ManageText;
class ValidationTextController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(){
        $validationTexts=ValidationText::all();
        $websiteLang=ManageText::all();
        return view('admin.validation-text.index',compact('validationTexts','websiteLang'));
    }

    public function update(Request $request){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $error=$valid_lang->where('lang_key','every')->first()->custom_text;
        foreach($request->customs as $index => $custom){

            if($request->customs[$index]==''){
                $notification=array(
                    'messege'=>$error,
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($notification);
            }

            $validationText=ValidationText::find($request->ids[$index]);
            $validationText->custom_text=$request->customs[$index];
            $validationText->save();
        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }

    public function notification(){
        $notifications=NotificationText::all();
        $websiteLang=ManageText::all();
        return view('admin.notification-text.index',compact('notifications','websiteLang'));
    }

    public function updateNotification(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $error=$valid_lang->where('lang_key','every')->first()->custom_text;
        foreach($request->customs as $index => $custom){
            if($request->customs[$index]==''){
                $notification=array(
                    'messege'=>$error,
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($notification);
            }

            $notificationText=NotificationText::find($request->ids[$index]);
            $notificationText->custom_text=$request->customs[$index];
            $notificationText->save();
        }
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }
}
