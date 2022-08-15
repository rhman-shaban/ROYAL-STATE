<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Listing;
use App\ManageText;
use App\Property;
use App\Setting;
class StaffDashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    public function dashboard(){
        $user=Auth::guard('staff')->user();
        $author_id=$user->author_id;
        $properties=Property::where('admin_id',$author_id)->orderBy('id','desc')->get();
        $settings=Setting::first();
        $websiteLang=ManageText::all();
        return view('staff.dashboard',compact('properties','settings','websiteLang'));
    }
}
