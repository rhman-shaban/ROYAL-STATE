<?php

namespace App\Http\Controllers\Admin;

use App\AboutSection;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutSectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $sections=AboutSection::all();
        $websiteLang=ManageText::all();
        return view('admin.about.about-section.index',compact('sections','websiteLang'));
    }




    public function sectionAboutUpdate(Request $request,$id){

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'show_homepage'=>'required',
        ];
        $customMessages = [
            'show_homepage.required' => $valid_lang->where('lang_key','show_homepage')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);



        $aboutSection=AboutSection::find($id);
        $aboutSection->show_homepage=$request->show_homepage;
        $aboutSection->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.about-section.index')->with($notification);
    }


    public function sectionFeatureUpdate(Request $request,$id){
         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end



        $valid_lang=ValidationText::all();
        $rules = [
            'header'=>'required',
            'description'=>'required',
            'show_homepage'=>'required',
            'content_quantity'=>'required',
        ];
        $customMessages = [
            'header.required' => $valid_lang->where('lang_key','header')->first()->custom_text,
            'description.required' => $valid_lang->where('lang_key','des')->first()->custom_text,
            'show_homepage.required' => $valid_lang->where('lang_key','show_homepage')->first()->custom_text,
            'content_quantity.required' => $valid_lang->where('lang_key','content_qty')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $aboutSection=AboutSection::find($id);
        $aboutSection->header=$request->header;
        $aboutSection->description=$request->description;
        $aboutSection->show_homepage=$request->show_homepage;
        $aboutSection->content_quantity=$request->content_quantity;
        $aboutSection->save();


        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.about-section.index')->with($notification);
    }




}
