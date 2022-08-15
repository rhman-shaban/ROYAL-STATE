<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Navigation;
use App\ManageText;
use App\PaymentAccount;
use App\BannerImage;
use App\NotificationText;
use App\Setting;
use Auth;
use Illuminate\Pagination\Paginator;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(){
        Paginator::useBootstrap();
        $user=Auth::guard('web')->user();
        $orders=Order::where(['user_id'=>$user->id])->orderBy('id','desc')->paginate(10);
        $currency=Setting::first();
        $websiteLang=ManageText::all();
        return view('user.profile.order.index',compact('orders','currency','websiteLang'));
    }


    public function show($id){
        $user=Auth::guard('web')->user();
        $order=Order::where(['user_id'=>$user->id,'id'=>$id])->first();
        if($order){
            $menus=Navigation::all();
            $currency=Setting::first();
            $logo=Setting::first();
            $websiteLang=ManageText::all();
            return view('user.profile.order.show',compact('order','websiteLang','menus','currency','logo'));
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return redirect()->route('user.dashboard')->with($notification);
        }

    }
}
