<?php

namespace App\Http\Controllers\Admin;

use App\Aminity;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\ListingAminity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
class AminityController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $aminities=Aminity::all();
        $websiteLang=ManageText::all();
        return view('admin.aminity.index',compact('aminities','websiteLang'));
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
            'aminity'=>'required|unique:aminities',
            'status'=>'required'

        ];
        $customMessages = [
            'aminity.required' => $valid_lang->where('lang_key','aminity')->first()->custom_text,
            'aminity.unique' => $valid_lang->where('lang_key','unique_aminity')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);

        $aminity=new Aminity();
        $aminity->aminity=$request->aminity;
        $aminity->slug=Str::slug($request->aminity);
        $aminity->status=$request->status;
        $aminity->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.aminity.index')->with($notification);
    }




    public function update(Request $request, Aminity $aminity)
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
            'aminity'=>'required|unique:aminities,aminity,'.$aminity->id,
            'status'=>'required'

        ];
        $customMessages = [
            'aminity.required' => $valid_lang->where('lang_key','aminity')->first()->custom_text,
            'aminity.unique' => $valid_lang->where('lang_key','unique_aminity')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);

        $aminity->aminity=$request->aminity;
        $aminity->slug=Str::slug($request->aminity);
        $aminity->status=$request->status;
        $aminity->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.aminity.index')->with($notification);
    }


    public function destroy(Aminity $aminity)
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

        $aminity->delete();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.aminity.index')->with($notification);
    }

    public function changeStatus($id){
        $aminity=Aminity::find($id);
        if($aminity->status==1){
            $aminity->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $aminity->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $aminity->save();
        return response()->json($message);

    }
}
