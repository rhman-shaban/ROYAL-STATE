<?php

namespace App\Http\Controllers\Admin;

use App\BlogCategory;
use App\Blog;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
class BlogCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories=BlogCategory::all();
        $blogs=Blog::all();
        $websiteLang=ManageText::all();
        return view('admin.blog-category.index',compact('categories','blogs','websiteLang'));
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
            'name'=>'required|unique:blog_categories',
            'slug'=>'required|unique:blog_categories',
            'status'=>'required'
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'name.unique' => $valid_lang->where('lang_key','unique_name')->first()->custom_text,
            'slug.required' => $valid_lang->where('lang_key','slug')->first()->custom_text,
            'slug.unique' => $valid_lang->where('lang_key','unique_slug')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        BlogCategory::create([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'status'=>$request->status,
        ]);

        $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.blog-category.index')->with($notification);
    }


    public function update(Request $request, BlogCategory $blogCategory)
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
            'name'=>'required|unique:blog_categories,name,'.$blogCategory->id,
            'slug'=>'required|unique:blog_categories,slug,'.$blogCategory->id,
            'status'=>'required'
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'name.unique' => $valid_lang->where('lang_key','unique_name')->first()->custom_text,
            'slug.required' => $valid_lang->where('lang_key','slug')->first()->custom_text,
            'slug.unique' => $valid_lang->where('lang_key','unique_slug')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);



        $blogCategory->name=$request->name;
        $blogCategory->slug=$request->slug;
        $blogCategory->status=$request->status;
        $blogCategory->save();

        $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.blog-category.index')->with($notification);
    }


    public function destroy(BlogCategory $blogCategory)
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
        $blogCategory->delete();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.blog-category.index')->with($notification);
    }

    public function changeStatus($id){
        $category=BlogCategory::find($id);
        if($category->status==1){
            $category->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $category->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }
        $category->save();
        return response()->json($message);

    }
}
