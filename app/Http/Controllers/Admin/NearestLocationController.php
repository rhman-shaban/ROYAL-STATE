<?php

namespace App\Http\Controllers\Admin;

use App\NearestLocation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
class NearestLocationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $locations=NearestLocation::all();
        $websiteLang=ManageText::all();
        return view('admin.nearest-location.index',compact('locations','websiteLang'));
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
            'location'=>'required|unique:nearest_locations',
            'status'=>'required'

        ];
        $customMessages = [
            'location.required' => $valid_lang->where('lang_key','loc')->first()->custom_text,
            'location.unique' => $valid_lang->where('lang_key','unique_loc')->first()->custom_text,


        ];
        $this->validate($request, $rules, $customMessages);

        $location=new NearestLocation();
        $location->location=$request->location;
        $location->slug=Str::slug($request->location);
        $location->status=$request->status;
        $location->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }




    public function update(Request $request, NearestLocation $nearestLocation)
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

        $rules = [
            'location'=>'required|unique:nearest_locations,location,'.$nearestLocation->id,
            'status'=>'required'
        ];


        $this->validate($request, $rules);
        $nearestLocation->location=$request->location;
        $nearestLocation->slug=Str::slug($request->location);
        $nearestLocation->status=$request->status;
        $nearestLocation->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }


    public function destroy(NearestLocation $nearestLocation)
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

        $nearestLocation->delete();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }


    public function changeStatus($id){
        $location=NearestLocation::find($id);
        if($location->status==1){
            $location->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $location->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $location->save();
        return response()->json($message);

    }
}
