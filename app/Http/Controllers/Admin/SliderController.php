<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use App\ManageText;
use Illuminate\Http\Request;
use Image;
use File;

use App\NotificationText;
use App\ValidationText;
class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $slider=Slider::first();
        $websiteLang=ManageText::all();
        return view('admin.slider.index',compact('slider','websiteLang'));
    }


    public function update(Request $request, $id)
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
            'header'=>'required'
        ];
        $customMessages = [
            'header.required' => $valid_lang->where('lang_key','header')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);



        $slider=Slider::find($id);

        if($request->image){
            $old_slider=$slider->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'home-page-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/website-images/'.$name;
            Image::make($image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path().'/'.$image_path);

                $slider->image=$image_path;
                $slider->header=$request->header;
                $slider->save();
                if(File::exists(public_path().'/'.$old_slider)) unlink(public_path().'/'.$old_slider);
        }

        $slider->header=$request->header;
        $slider->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return back()->with($notification);
    }



}
