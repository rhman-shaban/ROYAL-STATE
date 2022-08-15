<?php

namespace App\Http\Controllers\Admin;

use App\ConditionPrivacy;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConditionPrivacyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {

        $conditionPrivacy=ConditionPrivacy::first();
        $websiteLang=ManageText::all();
        if($conditionPrivacy){
            return view('admin.terms-privacy.edit',compact('conditionPrivacy','websiteLang'));
        }else{
            return view('admin.terms-privacy.create',compact('websiteLang'));
        }

    }


    public function store(Request $request)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'terms_condition'=>'required',
            'privacy_policy'=>'required',
        ];
        $customMessages = [
            'terms_condition.required' => $valid_lang->where('lang_key','terms_cond')->first()->custom_text,
            'privacy_policy.required' => $valid_lang->where('lang_key','privacy_policy')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);

        ConditionPrivacy::create([
            'terms_condition'=>$request->terms_condition,
            'privacy_policy'=>$request->privacy_policy
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.terms-privacy.index')->with($notification);
    }


    public function update(Request $request, $id)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'terms_condition'=>'required',
            'privacy_policy'=>'required',
        ];
        $customMessages = [
            'terms_condition.required' => $valid_lang->where('lang_key','terms_cond')->first()->custom_text,
            'privacy_policy.required' => $valid_lang->where('lang_key','privacy_policy')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);

        ConditionPrivacy::where('id',$id)->update([
            'terms_condition'=>$request->terms_condition,
            'privacy_policy'=>$request->privacy_policy
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.terms-privacy.index')->with($notification);
    }


}
