<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\SeoText;
Use App\ManageText;


use App\NotificationText;
use App\ValidationText;

class SeoTextController extends Controller
{




    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index($id){
        $text=SeoText::find($id);
        if($text){
            $websiteLang=ManageText::all();
            return view('admin.seo.index',compact('text','websiteLang'));
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return back()->with($notification);
        }


    }


    public function update(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'title'=>'required',
        ];
        $customMessages = [
            'title.required' => $valid_lang->where('lang_key','title')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);



        $text=SeoText::find($id);
        if($text){
            $text->title=$request->title;
            $text->meta_description=$request->meta_description;
            $text->save();

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return back()->with($notification);
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return back()->with($notification);
        }
    }
}
