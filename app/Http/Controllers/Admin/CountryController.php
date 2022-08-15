<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
class CountryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $countries=Country::all();
        $websiteLang=ManageText::all();
        return view('admin.country.index',compact('countries','websiteLang'));
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
            'name'=>'required|unique:countries'
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'name.unique' => $valid_lang->where('lang_key','unique_name')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);



        $country=new Country();
        $country->name=$request->name;
        $country->slug=Str::slug($request->name);
        $country->status=$request->status;
        $country->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }



    public function update(Request $request, Country $country)
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
            'name'=>'required|unique:countries,name,'.$country->id
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'name.unique' => $valid_lang->where('lang_key','unique_name')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);

        $country->name=$request->name;
        $country->slug=Str::slug($request->name);
        $country->status=$request->status;
        $country->save();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }


    public function destroy(Country $country)
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

        $country->delete();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


        // manage status
        public function changeStatus($id){
            $country=Country::find($id);
            if($country->status==1){
                $country->status=0;
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
                $message=$notification;
            }else{
                $country->status=1;
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
                $message=$notification;
            }
            $country->save();
            return response()->json($message);

        }
}
