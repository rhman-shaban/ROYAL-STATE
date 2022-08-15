<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Subscribe;
use App\ManageText;
use Carbon\Carbon;
use App\Order;
use App\Setting;
Use App\Property;
class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        // start manage chart
        $data=array();
        $start = new Carbon('first day of this month');
        $last = new Carbon('last day of this month');
        $first_date=$start->format('Y-m-d');
        $last_date=$last->format('Y-m-d');
        $today=date('Y-m-d');
        $length=date('d')-$start->format('d');
        for($i=1; $i<=$length+1; $i++){

            $date = '';
            if($i==1) $date=$first_date;
            else $date = $start->addDays(1)->format('Y-m-d');

            $sum=Order::whereDate('created_at',$date)->sum('amount_real_currency');
            $data[] = $sum;
        }
        $data=json_encode($data);
        // end manage chart




        $orders=Order::where('payment_status',1)->count();
        $properties=Property::all();


        $users=User::all();

        $subscriberQty=Subscribe::where('status',1)->count();


        $lastDayofMonth = \Carbon\Carbon::now()->endOfMonth()->toDateString();

        $monthlyEarning=Order::whereBetween('purchase_date', array($first_date,$lastDayofMonth))->where('payment_status',1)->sum('amount_real_currency');
        $totalEarning=Order::where('payment_status',1)->sum('amount_real_currency');


        $websiteLang=ManageText::all();
        $currency=Setting::first();
        return view('admin.dashboard',compact('orders','properties','users','subscriberQty','websiteLang','data','currency','monthlyEarning','totalEarning'));
    }
}
