<?php

namespace App\Http\Controllers\Admin;

use App\ContactUs;
use App\ContactMessage;
use App\ManageText;
use App\NotificationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function message(){
        $messages=ContactMessage::orderBy('id','desc')->get();
        $websiteLang=ManageText::all();
        return view('admin.contact.contact-message.index',compact('messages','websiteLang'));
    }

    public function destroyMessage($id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $message=ContactMessage::find($id);
        $message->delete();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);

    }
}
