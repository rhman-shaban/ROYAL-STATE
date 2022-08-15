<?php

namespace App\Http\Controllers\Admin;

use App\PropertyPurpose;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
class PropertyPurposeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $purposes=PropertyPurpose::all();
        $websiteLang=ManageText::all();
        return view('admin.property-purpose.index',compact('purposes','websiteLang'));
    }




    public function update(Request $request, PropertyPurpose $propertyPurpose)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();

        $rules = [
            'purpose'=>'required|unique:property_purposes,purpose,'.$propertyPurpose->id
        ];


        $customMessages = [
            'purpose.required' => $valid_lang->where('lang_key','purpose')->first()->custom_text,
        ];


        $this->validate($request, $rules, $customMessages);

        $propertyPurpose->custom_purpose=$request->purpose;
        $propertyPurpose->slug=Str::slug($request->purpose);
        $propertyPurpose->status=$request->status;
        $propertyPurpose->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }

    // manage status
    public function changeStatus($id){
        $purpose=PropertyPurpose::find($id);
        if($purpose->status==1){
            $purpose->status=0;
            $message='InActive Successfully';
        }else{
            $purpose->status=1;
            $message='Active Successfully';
        }
        $purpose->save();
        return response()->json($message);

    }

}
