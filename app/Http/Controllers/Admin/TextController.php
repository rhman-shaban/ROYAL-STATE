<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;

class TextController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $manageTexts=ManageText::all();
        $websiteLang=ManageText::all();
        return view('admin.manage-text.index',compact('manageTexts','websiteLang'));
    }

    public function update(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $error=$valid_lang->where('lang_key','every')->first()->custom_text;
        foreach($request->customs as $index => $custom){
            if($request->customs[$index]==''){

                $notification=array(
                    'messege'=>$error,
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($notification);
            }

            $manageText=ManageText::find($request->ids[$index]);
            $manageText->custom_text=$request->customs[$index];
            $manageText->save();
        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }
}
