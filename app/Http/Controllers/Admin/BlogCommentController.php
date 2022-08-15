<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BlogComment;
use App\ManageText;
use App\NotificationText;
class BlogCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function allComments(){
        $comments=BlogComment::all();
        $websiteLang=ManageText::all();
        $confirmNotify=$websiteLang->where('lang_key','are_you_sure')->first()->custom_text;
        return view('admin.blog-comment.index',compact('comments','websiteLang','confirmNotify'));
    }

    public function deleteComment($id){
         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // end
        BlogComment::destroy($id);
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);

    }

    // manage comment status
    public function changeStatus($id){
        $comment=BlogComment::find($id);
        if($comment->status==1){
            $comment->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $comment->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $comment->save();
        return response()->json($message);

    }
}
