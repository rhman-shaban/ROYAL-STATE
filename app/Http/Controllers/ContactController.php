<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactMessage;
use App\Setting;
use App\EmailTemplate;
use Mail;
use App\Mail\ContactMessageInformation;
use App\Rules\Captcha;
use App\NotificationText;
use App\ValidationText;
use App\Admin;
use App\User;

use App\Helpers\MailHelper;
use App\EmailConfiguration;
class ContactController extends Controller
{

    public function sendMessage(Request $request){

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
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
            'subject.required' => $valid_lang->where('lang_key','subject')->first()->custom_text,
            'message.required' => $valid_lang->where('lang_key','msg')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);

        $contact=[
            'email'=>$request->email,
            'phone'=>$request->phone,
            'name'=>$request->name,
            'subject'=>$request->subject,
            'message'=>$request->message,
        ];

        $setting=Setting::first();
        $notify=NotificationText::first();
        if($setting->save_contact_message==1){
            ContactMessage::create($contact);
        }

        MailHelper::setMailConfig();

        $template=EmailTemplate::where('id',2)->first();
        $message=$template->description;
        $subject=$template->subject;
        $message=str_replace('{{name}}',$contact['name'],$message);
        $message=str_replace('{{email}}',$contact['email'],$message);
        $message=str_replace('{{phone}}',$contact['phone'],$message);
        $message=str_replace('{{subject}}',$contact['subject'],$message);
        $message=str_replace('{{message}}',$contact['message'],$message);

        Mail::to($setting->email)->send(new ContactMessageInformation($message,$subject));


        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','msg')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return back()->with($notification);
    }

    public function messageForUser(Request $request){

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
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required',
            'user_type'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
            'subject.required' => $valid_lang->where('lang_key','subject')->first()->custom_text,
            'message.required' => $valid_lang->where('lang_key','msg')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $contact=[
            'email'=>$request->email,
            'phone'=>$request->phone,
            'name'=>$request->name,
            'subject'=>$request->subject,
            'message'=>$request->message,
        ];


        MailHelper::setMailConfig();

        if($request->user_type==1){
            $admin=Admin::find($request->admin_id);
            if($admin){
                $template=EmailTemplate::where('id',2)->first();
                $message=$template->description;
                $subject=$template->subject;
                $message=str_replace('{{name}}',$contact['name'],$message);
                $message=str_replace('{{email}}',$contact['email'],$message);
                $message=str_replace('{{phone}}',$contact['phone'],$message);
                $message=str_replace('{{subject}}',$contact['subject'],$message);
                $message=str_replace('{{message}}',$contact['message'],$message);

                Mail::to($admin->email)->send(new ContactMessageInformation($message,$subject));

                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','msg')->first()->custom_text;
                return response()->json(['success'=>$notification]);

            }else{
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
                return response()->json(['error'=>$notification]);
            }
        }else if($request->user_type==0){
            $user=User::find($request->user_id);
            if($user){
                $template=EmailTemplate::where('id',2)->first();
                $message=$template->description;
                $subject=$template->subject;
                $message=str_replace('{{name}}',$contact['name'],$message);
                $message=str_replace('{{email}}',$contact['email'],$message);
                $message=str_replace('{{phone}}',$contact['phone'],$message);
                $message=str_replace('{{subject}}',$contact['subject'],$message);
                $message=str_replace('{{message}}',$contact['message'],$message);

                Mail::to($user->email)->send(new ContactMessageInformation($message,$subject));

                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','msg')->first()->custom_text;
                return response()->json(['success'=>$notification]);

            }else{
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
                return response()->json(['error'=>$notification]);
            }
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            return response()->json(['error'=>$notification]);
        }
    }
}
