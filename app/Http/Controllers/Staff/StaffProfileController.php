<?php
namespace App\Http\Controllers\Staff;
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
class StaffProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    public function profile(){
        $admin=Auth::guard('staff')->user();
        $default_profile=BannerImage::find(15);
        $websiteLang=ManageText::all();
        return view('staff.profile.index',compact('admin','default_profile','websiteLang'));
    }

    public function updateProfile(Request $request){

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
            'email'=>'required',
            'password'=>'confirmed',
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
            'password.required' => $valid_lang->where('lang_key','pass')->first()->custom_text,

        ];
        $this->validate($request, $rules, $customMessages);

        $admin=Auth::guard('staff')->user();

        // inset user profile image
        if($request->file('image')){
            $old_image=$admin->image;
            $user_image=$request->image;
            $extention=$user_image->getClientOriginalExtension();
            $image_name= Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/custom-images/'.$image_name;

            Image::make($user_image)
                ->resize(600,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(400,400)
                ->save(public_path().'/'.$image_name);


            $admin->image=$image_name;
            $admin->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }

        }

        if($request->password){
            $admin->name=$request->name;
            $admin->email=$request->email;
            $admin->password=Hash::make($request->password);
            $admin->save();
        }else{
            $admin->name=$request->name;
            $admin->email=$request->email;
            $admin->save();
        }


        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('staff.profile')->with($notification);


    }
}
