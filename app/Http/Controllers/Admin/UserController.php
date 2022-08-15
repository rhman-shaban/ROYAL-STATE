<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Wishlist;
use App\Listing;
use App\ListingReview;
use App\ListingAminity;
use App\ListingVideo;
use App\ManageText;
use App\ListingImage;
use Image;
use File;

use App\NotificationText;
use App\ValidationText;
use App\BannerImage;
use App\Property;
use App\PropertyReview;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function index(){
        $users=User::all();
        $websiteLang=ManageText::all();
        $confirmNotify=$websiteLang->where('lang_key','are_you_sure')->first()->custom_text;
        return view('admin.user.index',compact('users','websiteLang','confirmNotify'));
    }

    public function show($id){
        $user=User::find($id);
        if($user){
            $websiteLang=ManageText::all();
            $default_profile_image=BannerImage::find(15);
            return view('admin.user.show',compact('user','websiteLang','default_profile_image'));
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');


            return redirect()->route('admin.agents')->with($notification);
        }

    }

    public function destroy($id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $user=User::where('id',$id)->first();
        $user_image=$user->image;
        $user_banner_image=$user->banner_image;

        Order::where('user_id',$id)->delete();
        Wishlist::where('user_id',$id)->delete();
        PropertyReview::where('user_id',$id)->delete();


        $user->delete();
        if($user_image){
            if(File::exists(public_path().'/'.$user_image)) unlink(public_path().'/'.$user_image);
        }
        if($user_banner_image){
            if(File::exists(public_path().'/'.$user_banner_image)) unlink(public_path().'/'.$user_banner_image);
        }



        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');


        return back()->with($notification);

    }


    public function changeStatus($id){
        $user=User::find($id);
        if($user->status==1){
            $user->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $user->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $user->save();
        return response()->json($message);

    }
}
