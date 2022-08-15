<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PropertyReview;
use App\ManageText;
use App\NotificationText;
class ListingReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $reviews=PropertyReview::orderBy('id','desc')->get();
        $websiteLang=ManageText::all();
        $confirmNotify=$websiteLang->where('lang_key','are_you_sure')->first()->custom_text;
        return view('admin.review.index',compact('reviews','websiteLang','confirmNotify'));
    }



    public function destroy($id)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $review=PropertyReview::find($id);
        $review->delete();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.listing-review')->with($notification);
    }

    public function changeStatus($id){
        $review=PropertyReview::find($id);
        if($review->status==1){
            $review->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $review->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $review->save();
        return response()->json($message);

    }
}
