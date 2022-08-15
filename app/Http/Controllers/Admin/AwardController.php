<?php

namespace App\Http\Controllers\Admin;

use App\Award;
use App\ManageText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
use App\NotificationText;
class AwardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $awards=Award::all();
        $websiteLang=ManageText::all();
        return view('admin.award.index',compact('awards','websiteLang'));
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
            'name'=>'required',
            'quantity'=>'required',
            'icon'=>'required',
            'image'=>'required',
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'quantity.required' => $valid_lang->where('lang_key','qty')->first()->custom_text,
            'icon.required' => $valid_lang->where('lang_key','icon')->first()->custom_text,
            'description.required' => $valid_lang->where('lang_key','des')->first()->custom_text,
            'image.required' => $valid_lang->where('lang_key','img')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $award=new Award();
        $image=$request->image;
        $extention=$image->getClientOriginalExtension();
        $image_name= 'award-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_name='uploads/custom-images/'.$image_name;

        Image::make($image)
            ->resize(800,null,function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path().'/'.$image_name);

        $award->name=$request->name;
        $award->qty=$request->quantity;
        $award->icon=$request->icon;
        $award->status=$request->status;
        $award->image=$image_name;
        $award->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }


    public function update(Request $request, Award $award)
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
            'quantity'=>'required',
            'icon'=>'required',
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'quantity.required' => $valid_lang->where('lang_key','qty')->first()->custom_text,
            'icon.required' => $valid_lang->where('lang_key','icon')->first()->custom_text,
            'description.required' => $valid_lang->where('lang_key','des')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);



        if($request->image){
            $old_image=$award->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $image_name= 'award-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/custom-images/'.$image_name;
            Image::make($image)
                ->resize(800,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path().'/'.$image_name);
            $award->image=$image_name;
            $award->save();
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);

        }


        $award->name=$request->name;
        $award->qty=$request->quantity;
        $award->icon=$request->icon;
        $award->status=$request->status;
        $award->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }


    public function destroy(Award $award)
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

        $old_image=$award->image;
        $award->delete();
        if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);


        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);

    }



    public function changeStatus($id){
        $award=Award::find($id);
        if($award->status==1){
            $award->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $award->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $award->save();
        return response()->json($message);

    }
}
