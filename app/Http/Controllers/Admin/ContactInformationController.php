<?php

namespace App\Http\Controllers\Admin;

use App\ContactInformation;
use App\ContactUs;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactInformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact=ContactInformation::first();
        $contact_us=ContactUs::first();
        $websiteLang=ManageText::all();
        return view('admin.contact.contact-information.edit',compact('contact','contact_us','websiteLang'));
    }


    public function update(Request $request, ContactInformation $contactInformation)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $valid_lang=ValidationText::all();
        $rules = [
            'address'=>'required',
            'about'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'map_embed_code'=>'required',
            'copyright'=>'required',
        ];
        $customMessages = [
            'address.required' => $valid_lang->where('lang_key','address')->first()->custom_text,
            'about.required' => $valid_lang->where('lang_key','about')->first()->custom_text,
            'phone.required' => $valid_lang->where('lang_key','phone')->first()->custom_text,
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
            'map_embed_code.required' => $valid_lang->where('lang_key','map')->first()->custom_text,
            'copyright.required' => $valid_lang->where('lang_key','copyright')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);



        ContactInformation::where('id',$contactInformation->id)->update([
            'address'=>$request->address,
            'about'=>$request->about,
            'phones'=>$request->phone,
            'emails'=>$request->email,
            'map_embed_code'=>$request->map_embed_code,
            'copyright'=>$request->copyright,
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.contact-information.index')->with($notification);
    }



    public function topbarContact(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $contact=ContactUs::find($id);
        $contact->topbar_phone=$request->topbar_phone;
        $contact->topbar_email=$request->topbar_email;
        $contact->save();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.contact-information.index')->with($notification);
    }

    public function footerContact(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $contact=ContactUs::find($id);
        $contact->footer_phone=$request->footer_phone;
        $contact->footer_email=$request->footer_email;
        $contact->footer_address=$request->footer_address;
        $contact->save();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.contact-information.index')->with($notification);
    }

    public function socialLink(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $contact=ContactUs::find($id);
        $contact->facebook=$request->facebook;
        $contact->twitter=$request->twitter;
        $contact->youtube=$request->youtube;
        $contact->linkedin=$request->linkedin;
        $contact->instagram=$request->instagram;
        $contact->save();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.contact-information.index')->with($notification);
    }



}
