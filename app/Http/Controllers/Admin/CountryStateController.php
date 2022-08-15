<?php

namespace App\Http\Controllers\Admin;

use App\CountryState;
use App\Country;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
class CountryStateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $states=CountryState::all();
        $countries=Country::all();
        $websiteLang=ManageText::all();
        return view('admin.country-state.index',compact('states','countries','websiteLang'));
    }

    public function create(){
        $countries=Country::all();
        $websiteLang=ManageText::all();
        return view('admin.country-state.create',compact('countries','websiteLang'));
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
            'country'=>'required',
            'name'=>'required|unique:country_states'
        ];
        $customMessages = [
            'country.required' => $valid_lang->where('lang_key','country')->first()->custom_text,
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'name.unique' => $valid_lang->where('lang_key','unique_name')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $state=new CountryState();
        $state->country_id=$request->country;
        $state->name=$request->name;
        $state->slug=Str::slug($request->name);
        $state->status=$request->status;
        $state->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }

    public function edit(CountryState $countryState){
        $countries=Country::all();
        $websiteLang=ManageText::all();
        return view('admin.country-state.edit',compact('countries','countryState','websiteLang'));
    }


    public function update(Request $request, CountryState $countryState)
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
            'country'=>'required',
            'name'=>'required|unique:country_states,name,'.$countryState->id
        ];
        $customMessages = [
            'country.required' => $valid_lang->where('lang_key','country')->first()->custom_text,
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'name.unique' => $valid_lang->where('lang_key','unique_name')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $countryState->country_id=$request->country;
        $countryState->name=$request->name;
        $countryState->slug=Str::slug($request->name);
        $countryState->status=$request->status;
        $countryState->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.country-state.index')->with($notification);
    }


    public function destroy(CountryState $countryState)
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

        $countryState->delete();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }


    // manage status
    public function changeStatus($id){
        $state=CountryState::find($id);
        if($state->status==1){
            $state->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $state->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $state->save();
        return response()->json($message);

    }
}
