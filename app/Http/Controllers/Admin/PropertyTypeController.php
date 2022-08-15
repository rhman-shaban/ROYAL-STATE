<?php

namespace App\Http\Controllers\Admin;

use App\PropertyType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
class PropertyTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $propertyTypes=PropertyType::all();
        $websiteLang=ManageText::all();
        return view('admin.listing-category.index',compact('propertyTypes','websiteLang'));
    }


    public function create()
    {
        $websiteLang=ManageText::all();
        return view('admin.listing-category.create',compact('websiteLang'));
    }


    public function store(Request $request)
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
            'type'=>'required|unique:property_types',
            'slug'=>'required|unique:property_types',
            'status'=>'required'
        ];
        $customMessages = [
            'type.required' => $valid_lang->where('lang_key','type')->first()->custom_text,
            'type.unique' => $valid_lang->where('lang_key','unique_type')->first()->custom_text,
            'slug.required' => $valid_lang->where('lang_key','slug')->first()->custom_text,
            'slug.unique' => $valid_lang->where('lang_key','unique_slug')->first()->custom_text,

        ];
        $this->validate($request, $rules, $customMessages);

        $type=new PropertyType();
        $type->type=$request->type;
        $type->slug=$request->slug;
        $type->status=$request->status;
        $type->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }




    public function edit(PropertyType $propertyType)
    {
        $websiteLang=ManageText::all();
        return view('admin.listing-category.edit',compact('propertyType','websiteLang'));
    }

    public function update(Request $request, PropertyType $propertyType)
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
            'type'=>'required|unique:property_types,type,'.$propertyType->id,
            'slug'=>'required|unique:property_types,slug,'.$propertyType->id,
            'status'=>'required'

        ];
        $customMessages = [
            'type.required' => $valid_lang->where('lang_key','type')->first()->custom_text,
            'type.unique' => $valid_lang->where('lang_key','unique_type')->first()->custom_text,
            'slug.required' => $valid_lang->where('lang_key','slug')->first()->custom_text,
            'slug.unique' => $valid_lang->where('lang_key','unique_slug')->first()->custom_text,

        ];
        $this->validate($request, $rules, $customMessages);


        $propertyType->type=$request->type;
        $propertyType->slug=$request->slug;
        $propertyType->status=$request->status;
        $propertyType->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.property-type.index')->with($notification);
    }


    public function destroy(PropertyType $propertyType)
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
        $propertyType->delete();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.property-type.index')->with($notification);
    }

    public function changeStatus($id){
        $type=PropertyType::find($id);
        if($type->status==1){
            $type->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $type->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $type->save();
        return response()->json($message);

    }
}
