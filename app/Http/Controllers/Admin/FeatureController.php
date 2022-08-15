<?php

namespace App\Http\Controllers\Admin;

use App\Feature;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
use App\BannerImage;
class FeatureController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $features=Feature::all();
        $websiteLang=ManageText::all();
        $feature_image=BannerImage::find(23);
        return view('admin.feature.index',compact('features','websiteLang','feature_image'));
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
            'title'=>'required|unique:features',
            'icon'=>'required',
            'description'=>'required',
            'status'=>'required',
        ];
        $customMessages = [
            'title.required' => $valid_lang->where('lang_key','title')->first()->custom_text,
            'title.unique' => $valid_lang->where('lang_key','unique_title')->first()->custom_text,
            'icon.required' => $valid_lang->where('lang_key','icon')->first()->custom_text,
            'icon.required' => $valid_lang->where('lang_key','des')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $feature=new Feature();
        $feature->title=$request->title;
        $feature->description=$request->description;
        $feature->icon=$request->icon;
        $feature->status=$request->status;
        $feature->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.feature.index')->with($notification);

    }


    public function update(Request $request, Feature $feature)
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
            'title'=>'required|unique:features,title,'.$feature->id,
            'icon'=>'required',
            'description'=>'required',
            'status'=>'required',
        ];
        $customMessages = [
            'title.required' => $valid_lang->where('lang_key','title')->first()->custom_text,
            'title.unique' => $valid_lang->where('lang_key','unique_title')->first()->custom_text,
            'icon.required' => $valid_lang->where('lang_key','icon')->first()->custom_text,
            'icon.required' => $valid_lang->where('lang_key','des')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);



        // update database
        $feature->title=$request->title;
        $feature->description=$request->description;
        $feature->icon=$request->icon;
        $feature->status=$request->status;
        $feature->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.feature.index')->with($notification);
    }

    public function destroy(Feature $feature)
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

        $feature->delete();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.feature.index')->with($notification);

    }


    public function changeStatus($id){
        $feature=Feature::find($id);
        if($feature->status==1){
            $feature->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $feature->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $feature->save();
        return response()->json($message);

    }


    public function featureImage(Request $request){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'image'=>'required'
        ]);

        $feature_image=BannerImage::find(23);

        $old_image=$feature_image->image;
        $image=$request->image;
        $extention=$image->getClientOriginalExtension();
        $name= 'faq-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
            ->resize(1000,null,function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path().'/'.$image_path);

        $feature_image->image=$image_path;
        $feature_image->save();

        if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);

    }
}
