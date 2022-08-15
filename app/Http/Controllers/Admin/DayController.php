<?php

namespace App\Http\Controllers\Admin;

use App\Day;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DayController extends Controller
{
    public $notify;
    public $errorTexts;
    public $websiteLang;

    public function __construct()
    {
        $this->middleware('auth:admin');

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;

        $notify=NotificationText::all();
        $this->notify=$notify;

        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;
    }

    public function index()
    {
        $websiteLang=$this->websiteLang;
        $days=Day::all();
        return view('admin.day.index',compact('days','websiteLang'));
    }


    public function update(Request $request, Day $day)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'custom_day'=>'required'
        ];

        $customMessages = [
            'custom_day.required' => $this->errorTexts->where('id',51)->first()->custom_text,


        ];

        $this->validate($request, $rules, $customMessages);

        $day->custom_day=$request->custom_day;
        $day->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.day.index')->with($notification);
    }

}
