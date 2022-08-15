<?php

namespace App\Http\Controllers\Admin;

use App\CustomPage;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
class CustomPageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $pages=CustomPage::all();
        $websiteLang=ManageText::all();
        return view('admin.custome-page.index',compact('pages','websiteLang'));
    }


    public function create()
    {
        $websiteLang=ManageText::all();
        return view('admin.custome-page.create',compact('websiteLang'));
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
            'page_name'=>'required|unique:custom_pages',
            'description'=>'required',
        ];
        $customMessages = [
            'page_name.required' => $valid_lang->where('lang_key','page_name')->first()->custom_text,
            'page_name.unique' => $valid_lang->where('lang_key','unique_page_name')->first()->custom_text,
            'description.required' => $valid_lang->where('lang_key','des')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $page=new CustomPage();
        $page->page_name=$request->page_name;
        $page->slug=Str::slug($request->page_name);
        $page->seo_title=$request->seo_title ? $request->seo_title : 'custom page seo title';
        $page->seo_description=$request->seo_description ? $request->seo_description : 'custom page seo description';
        $page->description=$request->description;
        $page->status=$request->status;
        $page->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.custom-page.index')->with($notification);
    }


    public function edit(CustomPage $customPage)
    {
        $page=$customPage;
        $websiteLang=ManageText::all();
        return view('admin.custome-page.edit',compact('page','websiteLang'));
    }


    public function update(Request $request, CustomPage $customPage)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end



        $valid_lang=ValidationText::all();
        $rules = [
            'page_name'=>'required|unique:custom_pages,page_name,'.$customPage->id,
            'description'=>'required',
        ];
        $customMessages = [
            'page_name.required' => $valid_lang->where('lang_key','page_name')->first()->custom_text,
            'page_name.unique' => $valid_lang->where('lang_key','unique_page_name')->first()->custom_text,
            'description.required' => $valid_lang->where('lang_key','des')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $customPage->page_name=$request->page_name;
        $customPage->slug=Str::slug($request->page_name);
        $customPage->seo_title=$request->seo_title ? $request->seo_title : 'custom page seo title';
        $customPage->seo_description=$request->seo_description ? $request->seo_description : 'custom page seo description';
        $customPage->description=$request->description;
        $customPage->status=$request->status;
        $customPage->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.custom-page.index')->with($notification);
    }


    public function destroy(CustomPage $customPage)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $customPage->delete();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.custom-page.index')->with($notification);
    }


    public function changeStatus($id){
        $page=CustomPage::find($id);
        if($page->status==1){
            $page->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $page->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $page->save();
        return response()->json($message);

    }
}
