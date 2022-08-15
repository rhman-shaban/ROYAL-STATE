<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Partner;
use App\ManageText;
use Illuminate\Http\Request;
use Image;
use File;
use App\NotificationText;
use App\ValidationText;
class PartnerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $partners=Partner::all();
        $websiteLang=ManageText::all();
        return view('admin.partner.index',compact('partners','websiteLang'));
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
            'image'=>'required',
            'name'=>'required',
            'designation'=>'required',
        ];
        $customMessages = [
            'image.required' => $valid_lang->where('lang_key','img')->first()->custom_text,
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'designation.required' => $valid_lang->where('lang_key','designation')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);

         // save image
         $image=$request->image;
         $extention=$image->getClientOriginalExtension();
         $name= 'partner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
         $image_path='uploads/custom-images/'.$name;

         Image::make($image)
         ->resize(800,null,function ($constraint) {
             $constraint->aspectRatio();
         })
         ->crop(400,400)
         ->save(public_path().'/'.$image_path);


        $partner=new Partner();
        $partner->image=$image_path;
        $partner->name=$request->name;
        $partner->designation=$request->designation;

        if($request->first_icon && $request->first_link){
            $partner->first_icon=$request->first_icon;
            $partner->first_link=$request->first_link;
        }

        if($request->second_icon && $request->second_link){
            $partner->second_icon=$request->second_icon;
            $partner->second_link=$request->second_link;
        }

        if($request->third_icon && $request->third_link){
            $partner->third_icon=$request->third_icon;
            $partner->third_link=$request->third_link;
        }

        if($request->four_icon && $request->four_link){
            $partner->four_icon=$request->four_icon;
            $partner->four_link=$request->four_link;
        }

        $partner->status=$request->status;
        $partner->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.partner.index')->with($notification);
    }

    public function update(Request $request, Partner $partner)
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
            'name'=>'required',
            'designation'=>'required',
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'designation.required' => $valid_lang->where('lang_key','designation')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        if($request->image){
            $old_image=$partner->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'partner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/custom-images/'.$name;


            Image::make($image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path().'/'.$image_path);


            $partner->image=$image_path;
            $partner->save();
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
        }

        $partner->name=$request->name;
        $partner->designation=$request->designation;
        $partner->first_icon=$request->first_icon;
        $partner->first_link=$request->first_link;
        $partner->second_icon=$request->second_icon;
        $partner->second_link=$request->second_link;
        $partner->third_icon=$request->third_icon;
        $partner->third_link=$request->third_link;
        $partner->four_icon=$request->four_icon;
        $partner->four_link=$request->four_link;
        $partner->status=$request->status;
        $partner->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.partner.index')->with($notification);
    }

    public function destroy(Partner $partner)
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


        $old_image=$partner->image;
        $partner->delete();

        if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.partner.index')->with($notification);
    }

    public function changeStatus($id){
        $partner=Partner::find($id);
        if($partner->status==1){
            $partner->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $partner->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $partner->save();
        return response()->json($message);

    }
}
