<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Property;
use App\PropertyReview;
use App\Wishlist;
use App\ManageText;
use App\Order;
use App\Setting;
use Auth;
class DashboardController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function dashboard(){

        $user=Auth::guard('web')->user();
        $properties=Property::where(['user_id'=>$user->id])->get();
        $publishProperty=0;
        $expiredProperty=0;
        $clientReviews=0;
        $myReviews=PropertyReview::where('user_id',$user->id)->get();
        $wishlists=Wishlist::where('user_id',$user->id)->get();
        $orders=Order::where(['user_id'=>$user->id])->get();
        $activeOrder=Order::where(['user_id'=>$user->id,'status'=>1])->first();
        $currency=Setting::first();
        foreach($properties as $property){
            if($property->status==1){
                if($property->expired_date==null){
                    $publishProperty +=1;
                }elseif($property->expired_date >= date('Y-m-d')){
                    $publishProperty +=1;
                }else{
                    $expiredProperty +=1;
                }
            }else{
                $expiredProperty +=1;
            }

            $clientReviews+= $property->reviews->count();


        }





        $websiteLang=ManageText::all();
        return view('user.profile.dashboard',compact('expiredProperty','publishProperty','myReviews','clientReviews','wishlists','orders','activeOrder','currency','websiteLang'));
    }
}
