<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Testimonial;
use App\ManageText;
use Illuminate\Http\Request;
use Image;
use File;

use App\NotificationText;
use App\ValidationText;

class TestimonialController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $websiteLang=ManageText::all();
        $testimonials=Testimonial::all();
        return view('admin.testimonial.index',compact('testimonials','websiteLang'));
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
            'designation'=>'required',
            'image'=>'required',
            'description'=>'required',
            'status'=>'required',
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'designation.required' => $valid_lang->where('lang_key','designation')->first()->custom_text,
            'image.required' => $valid_lang->where('lang_key','img')->first()->custom_text,
            'description.required' => $valid_lang->where('lang_key','des')->first()->custom_text,
            'status.required' => $valid_lang->where('lang_key','status')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $image=$request->image;
        $extention=$image->getClientOriginalExtension();
        $image_name= 'testimonial-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;


        $image_name='uploads/custom-images/'.$image_name;

        Image::make($image)
            ->resize(600,null,function ($constraint) {
                $constraint->aspectRatio();
            })
            ->crop(400,400)
            ->save(public_path().'/'.$image_name);


        $testimonial=new Testimonial();
        $testimonial->name=$request->name;
        $testimonial->designation=$request->designation;
        $testimonial->image=$image_name;
        $testimonial->description=$request->description;
        $testimonial->status=$request->status;
        $testimonial->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }

    public function update(Request $request, Testimonial $testimonial)
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
            'description'=>'required',
            'status'=>'required',
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'designation.required' => $valid_lang->where('lang_key','designation')->first()->custom_text,
            'description.required' => $valid_lang->where('lang_key','des')->first()->custom_text,
            'status.required' => $valid_lang->where('lang_key','status')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        if($request->file('image')){
            $old_image=$testimonial->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $image_name= 'testimonial-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/custom-images/'.$image_name;

            Image::make($image)
                ->resize(600,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(400,400)
                ->save(public_path().'/'.$image_name);


            $testimonial->image=$image_name;
            $testimonial->save();
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);

        }

        $testimonial->name=$request->name;
        $testimonial->designation=$request->designation;
        $testimonial->description=$request->description;
        $testimonial->status=$request->status;
        $testimonial->save();


        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');


        return back()->with($notification);

    }


    public function destroy(Testimonial $testimonial)
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

        $image=$testimonial->image;
        $testimonial->delete();
        if(File::exists(public_path().'/'.$image))unlink(public_path().'/'.$image);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');


        return back()->with($notification);
    }

    public function changeStatus($id){
        $testimonial=Testimonial::find($id);
        if($testimonial->status==1){
            $testimonial->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $testimonial->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $testimonial->save();
        return response()->json($message);

    }
}
