<?php

namespace App\Http\Controllers\Admin;

use App\Package;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
class PackageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $packages=Package::orderBy('package_order','asc')->get();
        $currency=Setting::first();
        $websiteLang=ManageText::all();
        return view('admin.property-package.index',compact('packages','currency','websiteLang'));
    }

    public function create()
    {
        $websiteLang=ManageText::all();
        return view('admin.property-package.create',compact('websiteLang'));
    }


    public function store(Request $request)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end



        $valid_lang=ValidationText::all();
        $rules = [
            'package_type'=>'required',
            'package_name'=>'required',
            'price'=> $request->package_type==1 ? 'required' :'',
            'number_of_days'=>'required',
            'number_of_property'=>'required',
            'number_of_aminities'=>'required',
            'number_of_nearest_place'=>'required',
            'number_of_photo'=>'required',
            'package_order'=>'required',
            'feature'=>'required',
            'top_property'=>'required',
            'urgent'=>'required',
            'number_of_feature_property'=>$request->feature==1 ? 'required' :'',
            'number_of_top_property'=>$request->top_property==1 ? 'required' :'',
            'number_of_urgent_property'=>$request->urgent==1 ? 'required' :'',
            'status'=>'required',

        ];
        $customMessages = [
            'package_type.required' => $valid_lang->where('lang_key','package_type')->first()->custom_text,
            'package_name.required' => $valid_lang->where('lang_key','package_name')->first()->custom_text,
            'price.required' => $valid_lang->where('lang_key','price')->first()->custom_text,
            'number_of_days.required' => $valid_lang->where('lang_key','number_of_day')->first()->custom_text,
            'number_of_property.required' => $valid_lang->where('lang_key','number_of_property')->first()->custom_text,
            'number_of_aminities.required' => $valid_lang->where('lang_key','number_of_aminity')->first()->custom_text,
            'number_of_nearest_place.required' => $valid_lang->where('lang_key','number_of_nearest_place')->first()->custom_text,
            'number_of_photo.required' => $valid_lang->where('lang_key','number_of_photo')->first()->custom_text,
            'package_order.required' => $valid_lang->where('lang_key','package_order')->first()->custom_text,
            'number_of_feature_property.required' => $valid_lang->where('lang_key','number_of_feature_property')->first()->custom_text,
            'number_of_top_property.required' => $valid_lang->where('lang_key','number_of_top_property')->first()->custom_text,
            'number_of_urgent_property.required' => $valid_lang->where('lang_key','number_of_urgent_property')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $package=new Package();
        $package->package_type=$request->package_type;
        $package->package_name=$request->package_name;
        $package->price=$request->price ? $request->price : 0;
        $package->number_of_days=$request->number_of_days;
        $package->number_of_property=$request->number_of_property;
        $package->number_of_aminities=$request->number_of_aminities;
        $package->number_of_nearest_place=$request->number_of_nearest_place;
        $package->number_of_photo=$request->number_of_photo;
        $package->is_featured=$request->feature;
        $package->is_top=$request->top_property;
        $package->is_urgent=$request->urgent;
        $package->number_of_feature_property=$request->number_of_feature_property ? $request->number_of_feature_property : 0;
        $package->number_of_top_property=$request->number_of_top_property ? $request->number_of_top_property : 0;
        $package->number_of_urgent_property=$request->number_of_urgent_property ? $request->number_of_urgent_property : 0;
        $package->status=$request->status;
        $package->package_order=$request->package_order;
        $package->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');


        return redirect()->route('admin.package.index')->with($notification);
    }



    public function edit(Package $package)
    {
        $websiteLang=ManageText::all();
        return view('admin.property-package.edit',compact('package','websiteLang'));
    }


    public function update(Request $request, Package $package)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'package_type'=>'required',
            'package_name'=>'required',
            'price'=> $request->package_type==1 ? 'required' :'',
            'number_of_days'=>'required',
            'number_of_property'=>'required',
            'number_of_aminities'=>'required',
            'number_of_nearest_place'=>'required',
            'number_of_photo'=>'required',
            'package_order'=>'required',
            'feature'=>'required',
            'top_property'=>'required',
            'urgent'=>'required',
            'number_of_feature_property'=>$request->feature==1 ? 'required' :'',
            'number_of_top_property'=>$request->top_property==1 ? 'required' :'',
            'number_of_urgent_property'=>$request->urgent==1 ? 'required' :'',
            'status'=>'required',

        ];
        $customMessages = [
            'package_type.required' => $valid_lang->where('lang_key','package_type')->first()->custom_text,
            'package_name.required' => $valid_lang->where('lang_key','package_name')->first()->custom_text,
            'price.required' => $valid_lang->where('lang_key','price')->first()->custom_text,
            'number_of_days.required' => $valid_lang->where('lang_key','number_of_day')->first()->custom_text,
            'number_of_property.required' => $valid_lang->where('lang_key','number_of_property')->first()->custom_text,
            'number_of_aminities.required' => $valid_lang->where('lang_key','number_of_aminity')->first()->custom_text,
            'number_of_nearest_place.required' => $valid_lang->where('lang_key','number_of_nearest_place')->first()->custom_text,
            'number_of_photo.required' => $valid_lang->where('lang_key','number_of_photo')->first()->custom_text,
            'package_order.required' => $valid_lang->where('lang_key','package_order')->first()->custom_text,
            'number_of_feature_property.required' => $valid_lang->where('lang_key','number_of_feature_property')->first()->custom_text,
            'number_of_top_property.required' => $valid_lang->where('lang_key','number_of_top_property')->first()->custom_text,
            'number_of_urgent_property.required' => $valid_lang->where('lang_key','number_of_urgent_property')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);

        $package->package_type=$request->package_type;
        $package->package_name=$request->package_name;
        $package->price=$request->package_type ==1 ? $request->price : 0;
        $package->number_of_days=$request->number_of_days;
        $package->number_of_property=$request->number_of_property;
        $package->number_of_aminities=$request->number_of_aminities;
        $package->number_of_nearest_place=$request->number_of_nearest_place;
        $package->number_of_photo=$request->number_of_photo;
        $package->is_featured=$request->feature;
        $package->is_top=$request->top_property;
        $package->is_urgent=$request->urgent;
        $package->number_of_feature_property=$request->feature ? $request->number_of_feature_property : 0;
        $package->number_of_top_property=$request->top_property==1 ? $request->number_of_top_property : 0;
        $package->number_of_urgent_property=$request->urgent ? $request->number_of_urgent_property : 0;
        $package->status=$request->status;
        $package->package_order=$request->package_order;
        $package->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');


        return redirect()->route('admin.package.index')->with($notification);
    }


    public function destroy(Package $package)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $package->delete();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');


        return redirect()->route('admin.package.index')->with($notification);
    }

    public function changeStatus($id){
        $package=Package::find($id);
        if($package->status==1){
            $package->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $package->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $package->save();
        return response()->json($message);

    }


}
