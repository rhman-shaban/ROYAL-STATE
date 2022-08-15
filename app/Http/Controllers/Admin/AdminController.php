<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Str;
use App\Property;
use File;
class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins=Admin::where('admin_type','!=',2)->get();
        $currentAdmin=Auth::guard('admin')->user();
        if($currentAdmin->admin_type==1){
            $websiteLang=ManageText::all();
            $properties=Property::all();
            return view('admin.admin.index',compact('admins','currentAdmin','websiteLang','properties'));
        }else{
            return back();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $websiteLang=ManageText::all();
        return view('admin.admin.create',compact('websiteLang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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



        $admin=new Admin();
        $admin->name=$request->name;
        $admin->slug=Str::slug($request->name);
        $admin->email=$request->email;
        $admin->password=Hash::make($request->password);
        $admin->status=$request->status;
        $admin->save();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.admin-list.index')->with($notification);
    }

    public function destroy($id)
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
        $admin=Admin::find($id);
        $old_image=$admin->image;
        $admin->delete();

        if($old_image){
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.admin-list.index')->with($notification);
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
