<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CountryState;
use Str;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
class CityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $cities=City::all();
        $websiteLang=ManageText::all();
        return view('admin.city.index',compact('cities','websiteLang'));
    }


    public function create()
    {
        $states=CountryState::all();
        $websiteLang=ManageText::all();
        return view('admin.city.create',compact('states','websiteLang'));
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
            'state'=>'required',
            'name'=>'required|unique:cities'
        ];
        $customMessages = [
            'state.required' => $valid_lang->where('lang_key','state')->first()->custom_text,
            'name.required' => $valid_lang->where('lang_key','city')->first()->custom_text,
            'name.unique' => $valid_lang->where('lang_key','unique_city')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $city=new City();
        $city->country_state_id=$request->state;
        $city->name=$request->name;
        $city->slug=Str::slug($request->name);
        $city->status=$request->status;
        $city->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }


    public function show(City $city)
    {
        //
    }


    public function edit(City $city)
    {
        $states=CountryState::all();
        $websiteLang=ManageText::all();
        return view('admin.city.edit',compact('states','city','websiteLang'));
    }


    public function update(Request $request, City $city)
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
            'state'=>'required',
            'name'=>'required|unique:cities,name,'.$city->id
        ];
        $customMessages = [
            'state.required' => $valid_lang->where('lang_key','state')->first()->custom_text,
            'name.required' => $valid_lang->where('lang_key','city')->first()->custom_text,
            'name.unique' => $valid_lang->where('lang_key','unique_city')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $city->country_state_id=$request->state;
        $city->name=$request->name;
        $city->slug=Str::slug($request->name);
        $city->status=$request->status;
        $city->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.city.index')->with($notification);
    }

    public function destroy(City $city)
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

        $city->delete();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }


    // manage status
    public function changeStatus($id){
        $city=City::find($id);
        if($city->status==1){
            $city->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $city->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $city->save();
        return response()->json($message);

    }
}
