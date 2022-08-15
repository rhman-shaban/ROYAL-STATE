<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Wishlist;
use App\NotificationText;
use App\ManageText;
use App\Navigation;
use App\Day;
use Auth;
use Illuminate\Pagination\Paginator;
class WishlistController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function wishlist(){
        Paginator::useBootstrap();
        $user=Auth::guard('web')->user();
        $wishlists=Wishlist::with('property')->where('user_id',$user->id)->paginate(10);
        $websiteLang=ManageText::all();
        return view('user.profile.wishlist',compact('wishlists','websiteLang'));
    }

    public function create($id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // end

        $user=Auth::guard('web')->user();
        $isExist=Wishlist::where(['property_id'=>$id, 'user_id'=>$user->id])->first();
        if(!$isExist){
            $wishlist=new Wishlist();
            $wishlist->user_id=$user->id;
            $wishlist->property_id=$id;
            $wishlist->save();

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','wishlist')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->back()->with($notification);
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','already_wishlist')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
    }

    public function delete($id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // end

        $wishlist=Wishlist::find($id);
        $wishlist->delete();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
