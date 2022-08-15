<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
use Config;
use App\Setting;
use App\Admin;
use App\Blog;
use App\BlogCategory;
use App\BlogComment;

use App\ConditionPrivacy;
use App\ContactMessage;
use App\ContactUs;

use App\Feature;
use App\Location;
use App\Order;
use App\Partner;

use App\PropertyReview;
use App\Subscribe;
use App\Testimonial;
use App\User;
use App\EmailTemplate;
use App\Aminity;
use App\PropertyAminity;
use App\PropertyType;
use App\Package;
use App\Wishlist;
use App\ModalConsent;
use App\ManageText;
use App\Navigation;

use App\NotificationText;
use App\ValidationText;
use App\CustomPage;
use App\Award;
use App\City;
use App\Country;
use App\CountryState;
use App\Faq;
use App\NearestLocation;
use App\Property;
use App\PropertyImage;
use App\PropertyNearestLocation;
use App\PropertyPurpose;
use App\Service;
use App\Currency;


class SettingsController extends Controller
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
        $setting=Setting::first();
        if($setting){

            $websiteLang=ManageText::all();
            $menus=Navigation::all();
            $currencies = Currency::orderBy('name','asc')->get();
            return view('admin.settings.index',compact('setting','websiteLang','menus','currencies'));
        }
    }


    public function update(Request $request, Setting $setting)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required',
            'currency_name'=>'required',
            'currency_icon'=>'required',
            'currency_rate'=>'required|numeric',
            'prenotification_day'=>'required',
            'dashboard_header'=>'required',
            'dashbaord_header_icon'=>'required',
        ];
        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
            'currency_name.required' => $valid_lang->where('lang_key','currency_name')->first()->custom_text,
            'currency_icon.required' => $valid_lang->where('lang_key','currency_icon')->first()->custom_text,
            'currency_rate.required' => $valid_lang->where('lang_key','currency_rate')->first()->custom_text,
            'prenotification_day.required' => $valid_lang->where('lang_key','pre_notify')->first()->custom_text,
            'dashboard_header.required' => $valid_lang->where('lang_key','sidebar_header')->first()->custom_text,
            'dashbaord_header_icon.required' => $valid_lang->where('lang_key','sidebar_icon')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


         // for logo
        if($request->logo){
            $old_logo=$setting->logo;
            $image=$request->logo;
            $ext=$image->getClientOriginalExtension();
            $logo_name= 'logo-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_name='uploads/website-images/'.$logo_name;
            $logo=Image::make($image)
                    ->save(public_path().'/'.$logo_name);
            $setting->logo=$logo_name;
            $setting->save();
            if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
        }


     // for favicon
        if($request->favicon){
            $old_favicon=$setting->favicon;
            $favicon=$request->favicon;
            $ext=$favicon->getClientOriginalExtension();
            $favicon_name= 'favicon-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $favicon_name='uploads/website-images/'.$favicon_name;
            Image::make($favicon)
                    ->save(public_path().'/'.$favicon_name);
            $setting->favicon=$favicon_name;
            if(File::exists(public_path().'/'.$old_favicon))unlink(public_path().'/'.$old_favicon);
        }

        $setting->email=$request->email;
        $setting->save_contact_message=$request->save_contact_message;
        $setting->text_direction=$request->text_direction;
        $setting->currency_name=$request->currency_name;
        $setting->currency_icon=$request->currency_icon;
        $setting->currency_rate=$request->currency_rate;
        $setting->prenotification_day=$request->prenotification_day;
        $setting->timezone=$request->timezone;
        $setting->dashboard_header=$request->dashboard_header;
        $setting->dashbaord_header_icon=$request->dashbaord_header_icon;
        $setting->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.settings.index')->with($notification);


    }


    public function blogCommentSetting(){
        $setting=Setting::first();
        $websiteLang=ManageText::all();
        $menus=Navigation::all();
        return view('admin.settings.blog-comment.index',compact('setting','websiteLang','menus'));
    }

    public function updateCommentSetting(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->comment_type==0){
            $valid_lang=ValidationText::all();
            $rules = [
                'facebook_comment_script'=>'required'
            ];
            $customMessages = [
                'facebook_comment_script.required' => $valid_lang->where('lang_key','fb_comment')->first()->custom_text,
            ];
            $this->validate($request, $rules, $customMessages);

        }

        $setting=Setting::first();
        $setting->comment_type=$request->comment_type;
        $setting->facebook_comment_script=$request->facebook_comment_script;
        $setting->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }


    public function cookieConsentSetting(){
        $setting=ModalConsent::first();
        $websiteLang=ManageText::all();
        $menus=Navigation::all();
        return view('admin.settings.cookie-consent.index',compact('setting','websiteLang','menus'));
    }

    public function updateCookieConsentSetting(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->allow==1){


            $valid_lang=ValidationText::all();
            $rules = [
                'allow'=>'required',
                'border'=>'required',
                'corners'=>'required',
                'background_color'=>'required',
                'text_color'=>'required',
                'border_color'=>'required',
                'button_color'=>'required',
                'btn_text_color'=>'required',
                'link_text'=>'required',
                'btn_text'=>'required',
                'message'=>'required'
            ];
            $customMessages = [
                'allow.required' => $valid_lang->where('lang_key','allow')->first()->custom_text,
                'border.required' => $valid_lang->where('lang_key','border')->first()->custom_text,
                'corners.required' => $valid_lang->where('lang_key','corner')->first()->custom_text,
                'background_color.required' => $valid_lang->where('lang_key','bg_color')->first()->custom_text,
                'text_color.required' => $valid_lang->where('lang_key','text_color')->first()->custom_text,
                'border_color.required' => $valid_lang->where('lang_key','border_color')->first()->custom_text,
                'button_color.required' => $valid_lang->where('lang_key','button_color')->first()->custom_text,
                'btn_text_color.required' => $valid_lang->where('lang_key','button_text_color')->first()->custom_text,
                'link_text.required' => $valid_lang->where('lang_key','link_text')->first()->custom_text,
                'btn_text.required' => $valid_lang->where('lang_key','button_text')->first()->custom_text,
                'message.required' => $valid_lang->where('lang_key','msg')->first()->custom_text,
            ];
            $this->validate($request, $rules, $customMessages);
        }

        $modalConsent=ModalConsent::first();
        $modalConsent->status=$request->allow;
        $modalConsent->border=$request->border;
        $modalConsent->corners=$request->corners;
        $modalConsent->background_color=$request->background_color;
        $modalConsent->text_color=$request->text_color;
        $modalConsent->border_color=$request->border_color;
        $modalConsent->btn_bg_color=$request->button_color;
        $modalConsent->btn_text_color=$request->btn_text_color;
        $modalConsent->link_text=$request->link_text;
        $modalConsent->btn_text=$request->btn_text;
        $modalConsent->message=$request->message;
        $modalConsent->save();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function captchaSetting(){
        $setting=Setting::first();
        $websiteLang=ManageText::all();
        $menus=Navigation::all();
        return view('admin.settings.google-captcha.index',compact('setting','websiteLang','menus'));
    }

    public function updateCaptchaSetting(Request $request){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        if($request->allow_captcha==1){
            $valid_lang=ValidationText::all();
            $rules = [
                'captcha_key'=>'required',
                'captcha_secret'=>'required',
            ];
            $customMessages = [
                'captcha_key.required' => $valid_lang->where('lang_key','captcha_key')->first()->custom_text,
                'captcha_secret.required' => $valid_lang->where('lang_key','captcha_secret')->first()->custom_text,
            ];
            $this->validate($request, $rules, $customMessages);
        }

        $setting=Setting::first();
        $setting->allow_captcha=$request->allow_captcha;
        $setting->captcha_key=$request->captcha_key;
        $setting->captcha_secret=$request->captcha_secret;
        $setting->save();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }

    public function clearDatabase(){
        $websiteLang=ManageText::all();
        $menus=Navigation::all();
        return view('admin.settings.clear-database.index',compact('websiteLang','menus'));
    }

    public function destroyDatabase(){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        Aminity::truncate();
        Award::truncate();
        Blog::truncate();
        BlogCategory::truncate();
        BlogComment::truncate();
        City::truncate();
        ConditionPrivacy::truncate();
        ContactMessage::truncate();
        Country::truncate();
        CountryState::truncate();
        CustomPage::truncate();
        Faq::truncate();
        Feature::truncate();
        NearestLocation::truncate();
        Order::truncate();
        Package::truncate();
        Partner::truncate();
        Property::truncate();
        PropertyAminity::truncate();
        PropertyImage::truncate();
        PropertyNearestLocation::truncate();
        PropertyReview::truncate();
        PropertyType::truncate();
        Service::truncate();
        Subscribe::truncate();
        Testimonial::truncate();
        User::truncate();
        Wishlist::truncate();

        $admins=Admin::where('admin_type','!=',1)->get();
        foreach($admins as $admin){
            $image=$admin->image;
            $banner_image=$admin->banner_image;
            $admin->delete();
            if($image){
                if(File::exists(public_path().'/'.$image))unlink(public_path().'/'.$image);
            }
            if($banner_image){
                if(File::exists(public_path().'/'.$banner_image))unlink(public_path().'/'.$banner_image);
            }

        }

        $folderPath = public_path('uploads/custom-images');
        $response = File::deleteDirectory($folderPath);

        $path = public_path('uploads/custom-images');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);

        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.dashboard')->with($notification);

    }


    public function livechatSetting(){
        $setting=Setting::first();
        $websiteLang=ManageText::all();
        $menus=Navigation::all();
        return view('admin.settings.live-chat.index',compact('setting','websiteLang','menus'));
    }

    public function updateLivechatSetting(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->live_chat==1){

            $valid_lang=ValidationText::all();
            $rules = [
                'livechat_script'=>'required'
            ];
            $customMessages = [
                'livechat_script.required' => $valid_lang->where('lang_key','live_chat')->first()->custom_text,
            ];
            $this->validate($request, $rules, $customMessages);

        }

        $setting=Setting::first();
        $setting->live_chat=$request->live_chat;
        $setting->livechat_script=$request->livechat_script;
        $setting->save();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function preloaderSetting(){
        $setting=Setting::first();
        $websiteLang=ManageText::all();
        $menus=Navigation::all();

        return view('admin.settings.preloader.index',compact('setting','websiteLang','menus'));

    }

    public function preloaderUpdate(Request $request,$id){
        // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        $setting=Setting::find($id);
        if($request->preloader_image){

            $old_preloader=$setting->preloader_image;

            if(File::exists(public_path().'/'.$old_preloader))unlink(public_path().'/'.$old_preloader);

            $ext = $request->file('preloader_image')->extension();
            $final_name = 'preloader_image-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $request->file('preloader_image')->move(public_path('uploads/website-images/'), $final_name);
            $setting->preloader_image='uploads/website-images/'.$final_name;
            $setting->preloader=$request->preloader;
            $setting->save();

        }else{
            $setting->preloader=$request->preloader;
            $setting->save();
        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function googleAnalytic(){
        $setting=Setting::first();
        $websiteLang=ManageText::all();
        $menus=Navigation::all();
        return view('admin.settings.google-analytic.index',compact('setting','websiteLang','menus'));
    }

    public function googleAnalyticUpdate(Request $request){

              // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->google_analytic==1){



            $valid_lang=ValidationText::all();
            $rules = [
                'google_analytic_code'=>'required'
            ];
            $customMessages = [
                'google_analytic_code.required' => $valid_lang->where('lang_key','analytic')->first()->custom_text,
            ];
            $this->validate($request, $rules, $customMessages);

        };

        $setting=Setting::first();
        $setting->google_analytic=$request->google_analytic;
        $setting->google_analytic_code=$request->google_analytic_code;
        $setting->save();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }



    public function themeColor(){
        $setting=Setting::first();
        $websiteLang=ManageText::all();
        return view('admin.settings.theme-color.index',compact('setting','websiteLang'));
    }

    public function themeColorUpdate(Request $request){

              // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $setting=Setting::first();
        $setting->theme_one=$request->theme_one;
        $setting->theme_two=$request->theme_two;
        $setting->theme_three=$request->theme_three;
        $setting->save();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function emailTemplate(){
        $templates=EmailTemplate::all();
        $websiteLang=ManageText::all();
        $setting=Setting::first();
        return view('admin.settings.email-template.index',compact('templates','websiteLang','setting'));
    }

    public function editEmail($id){


        $email=EmailTemplate::find($id);
        $websiteLang=ManageText::all();
        $setting=Setting::first();
        if($id==1){
            return view('admin.settings.email-template.reset-edit',compact('email','websiteLang','setting'));
        }else if($id==2){
            return view('admin.settings.email-template.contact-edit',compact('email','websiteLang','setting'));
        }else if($id==3){
            return view('admin.settings.email-template.doctor-login-edit',compact('email','setting'));
        }else if($id==4){
            return view('admin.settings.email-template.subscribe-edit',compact('email','websiteLang','setting'));
        }else if($id==5){
            return view('admin.settings.email-template.verification-edit',compact('email','websiteLang','setting'));
        }else if($id==6){
            return view('admin.settings.email-template.order-edit',compact('email','websiteLang','setting'));
        }else if($id==7){
            return view('admin.settings.email-template.pre-notification',compact('email','websiteLang','setting'));
        }else if($id==8){
            return view('admin.settings.email-template.payment-accept',compact('email','websiteLang','setting'));
        }
    }

    public function updateEmail(Request $request,$id){

              // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'subject'=>'required',
            'description'=>'required',
        ];
        $customMessages = [
            'subject.required' => $valid_lang->where('lang_key','subject')->first()->custom_text,
            'description.required' => $valid_lang->where('lang_key','des')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        EmailTemplate::where('id',$id)->update([
            'subject'=>$request->subject,
            'description'=>$request->description
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.email.template')->with($notification);
    }

}
