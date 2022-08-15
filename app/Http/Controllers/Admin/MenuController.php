<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Navigation;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
class MenuController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $navigations=Navigation::all();
        $websiteLang=ManageText::all();
        return view('admin.navbar.index',compact('navigations','websiteLang'));
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
        foreach($request->navbars as $index => $navbar){

            if($request->navbars[$index]==''){
                $notification=array(
                    'messege'=>$error,
                    'alert-type'=>'error'
                );

                return redirect()->route('admin.menu-section')->with($notification);
            }

            $navigation=Navigation::find($request->ids[$index]);
            $navigation->navbar=$request->navbars[$index];
            $navigation->save();
        }
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.menu-section')->with($notification);
    }


    public function changeStatus($id){
        $navbar=Navigation::find($id);
        if($navbar->status==1){
            $navbar->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $navbar->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $navbar->save();
        return response()->json($message);

    }
}
