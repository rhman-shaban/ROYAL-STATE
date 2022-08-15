<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use App\BannerImage;
use App\ManageText;
use Image;
use Hash;
use File;
use Str;

use App\NotificationText;
use App\ValidationText;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function profile(){
        $admin=Auth::guard('admin')->user();
        $default_profile=BannerImage::find(15);
        $websiteLang=ManageText::all();
        $image=BannerImage::find(18);
        return view('admin.profile.index',compact('admin','default_profile','websiteLang','image'));
    }

    public function updateProfile(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'name'=>'required',
            'email'=>'required',
            'password'=>'confirmed',
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
            'password.required' => $valid_lang->where('lang_key','pass')->first()->custom_text,

        ];
        $this->validate($request, $rules, $customMessages);



        $admin=Auth::guard('admin')->user();

        // inset user profile image
        if($request->file('image')){
            $old_image=$admin->image;
            $user_image=$request->image;
            $extention=$user_image->getClientOriginalExtension();
            $image_name= Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/website-images/'.$image_name;

            Image::make($user_image)
                ->resize(600,null,function ($constraint) {
                    $constraint->aspectRatio();
                })->crop(400,400)->save(public_path().'/'.$image_name);



            $admin->image=$image_name;
            $admin->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);

            }

        }

        if($request->file('banner_image')){
            $old_banner_image=$admin->banner_image;
            $banner_image=$request->banner_image;
            $banner_ext=$banner_image->getClientOriginalExtension();
            $banner_name= 'listing-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$banner_ext;
            $banner_path='uploads/website-images/'.$banner_name;

            Image::make($banner_image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path().'/'.$banner_path);


            $admin->banner_image=$banner_path;
            $admin->save();
            if($old_banner_image){
                if(File::exists(public_path().'/'.$old_banner_image)) unlink(public_path().'/'.$old_banner_image);
            }

        }

        if($request->password){
            $admin->name=$request->name;
            $admin->slug=Str::slug($request->name);
            $admin->email=$request->email;
            $admin->password=Hash::make($request->password);

            $admin->address=$request->address;
            $admin->email=$request->email;
            $admin->phone=$request->phone;
            $admin->website=$request->website;
            $admin->facebook=$request->facebook;
            $admin->twitter=$request->twitter;
            $admin->linkedin=$request->linkedin;
            $admin->whatsapp=$request->whatsapp;
            $admin->about=$request->about;
            $admin->save();
        }else{
            $admin->name=$request->name;
            $admin->slug=Str::slug($request->name);
            $admin->email=$request->email;
            $admin->address=$request->address;
            $admin->email=$request->email;
            $admin->phone=$request->phone;
            $admin->website=$request->website;
            $admin->facebook=$request->facebook;
            $admin->twitter=$request->twitter;
            $admin->linkedin=$request->linkedin;
            $admin->whatsapp=$request->whatsapp;
            $admin->about=$request->about;
            $admin->save();
        }


        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.profile')->with($notification);


    }
}
