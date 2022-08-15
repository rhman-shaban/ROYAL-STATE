<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use App\ManageText;
use Image;
use Hash;
use Str;
use App\NotificationText;
use App\ValidationText;
use File;
class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(){
        $user=Auth::guard('admin')->user();
        $websiteLang=ManageText::all();
        if($user->admin_type==1){
            $staffs=Admin::where('admin_type',2)->get();
            $admins=Admin::all();
            return view('admin.staff.index',compact('staffs','admins','user','websiteLang'));
        }else if($user->amdin_type==0){
            $staffs=Admin::where('author_id',$user->id)->get();
            $admins=Admin::all();
            return view('admin.staff.index',compact('staffs','admins','user','websiteLang'));
        }


    }

    public function create(){
        $websiteLang=ManageText::all();
        return view('admin.staff.create',compact('websiteLang'));
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
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
            'password.required' => $valid_lang->where('lang_key','pass')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $user=Auth::guard('admin')->user();
        $admin=new Admin();
        $admin->name=$request->name;
        $admin->slug=Str::slug($request->name);
        $admin->email=$request->email;
        $admin->password=Hash::make($request->password);
        $admin->admin_type=2;
        $admin->author_id=$user->id;
        $admin->status=$request->status;
        $admin->save();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.staff')->with($notification);
    }

    public function destroy($id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // end
        $isAdmin=Admin::find($id);
        if($isAdmin){
            $old_image=$isAdmin->image;
            $isAdmin->delete();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return redirect()->back()->with($notification);
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return back()->with($notification);
        }



    }

    // manage blog status
    public function changeStatus($id){
        $admin=Admin::find($id);
        if($admin->status==1){
            $admin->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $admin->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $admin->save();
        return response()->json($message);

    }
}
