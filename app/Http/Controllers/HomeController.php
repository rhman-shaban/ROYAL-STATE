<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\HomeSection;
use App\Feature;
use App\Blog;
use App\Testimonial;
use App\About;
use App\AboutSection;
use App\Partner;
use App\BlogCategory;
use App\ContactUs;
use App\Setting;
use App\BlogComment;
use App\Rules\Captcha;
use App\ContactInformation;
use App\Location;
use App\Listing;
use App\Day;
use App\Aminity;
use App\Wishlist;
use App\ListingReview;
use App\Subscribe;
use App\ConditionPrivacy;
use App\EmailTemplate;
use App\SeoText;
use App\BannerImage;
use App\NotificationText;
use App\ValidationText;
use App\ManageText;
use App\Navigation;
use App\CustomPage;
use Storage;
use Str;
use Mail;
use Session;
use App\Mail\SubscribeUsNotification;
use Auth;
use App\Order;
use App\CustomPaginator;
use App\Admin;
use App\User;
use App\Helpers\MailHelper;
use App\Award;
use App\Service;
use App\Faq;
use App\Property;
use App\Package;
use App\PropertyType;
use App\City;
use App\PropertyAminity;
use DB;
use Schema;
use File;
use Illuminate\Pagination\Paginator;
class HomeController extends Controller
{

    public function index(){
        $banner=Slider::first();
        $blogs=Blog::where(['status'=>1,'show_homepage'=>1])->get();
        $seo_text=SeoText::find(1);
        $sections=HomeSection::all();
        $currency=Setting::first();
        $awards=Award::where('status',1)->get();
        $services=Service::where('status',1)->get();
        $default_profile_image=BannerImage::find(15);
        $testimonials=Testimonial::where('status',1)->get();
        $properties=Property::where('status',1)->get();
        $agents=User::where('status',1)->orderBy('id','desc')->get();
        $orders=Order::where(['status'=>1])->get();
        $propertyTypes=PropertyType::where('status',1)->orderBy('type','asc')->get();
        $cities=City::where('status',1)->orderBy('name','asc')->get();
        $features=Feature::all();
        $feature_image=BannerImage::find(23);
        $testimonial_bg=BannerImage::find(25);
        $agent_bg=BannerImage::find(26);
        $websiteLang=ManageText::all();
        return view('user.index',compact('banner','blogs','seo_text','sections','currency','awards','services','default_profile_image','testimonials','properties','agents','orders','feature_image','features','propertyTypes','cities','websiteLang','testimonial_bg','agent_bg'));
    }



    public function aboutUs(){
        $about=About::first();
        $banner_image=BannerImage::find(2);
        $awards=Award::where('status',1)->get();
        $partners=Partner::where('status',1)->get();
        $sections=AboutSection::all();
        $seo_text=SeoText::find(3);
        $menus=Navigation::all();
        $websiteLang=ManageText::all();
        return view('user.about-us',compact('about','banner_image','awards','partners','sections','seo_text','menus','websiteLang'));
    }


    public function blog(){
        Paginator::useBootstrap();
        $banner_image=BannerImage::find(5);
        $paginator=CustomPaginator::where('id',1)->first()->qty;
        $blogs=Blog::where('status',1)->orderBy('id','desc')->paginate($paginator);
        $seo_text=SeoText::find(6);
        $menus=Navigation::all();
        $websiteLang=ManageText::all();
        return view('user.blog.index',compact('banner_image','blogs','seo_text','menus','websiteLang'));
    }

    public function blogDetails($slug){

        $blog=Blog::where(['slug'=>$slug,'status'=>1])->first();
        if($blog){
            $blog->view +=1;
            $blog->save();

            $blogCategories=BlogCategory::where('status',1)->get();
            $popularBlogs=Blog::where('id','!=',$blog->id)->orderBy('view','desc')->get()->take(6);
            $commentSetting=Setting::first();
            $banner_image=BannerImage::find(5);
            $menus=Navigation::all();
            $default_profile_image=BannerImage::find(15);
            $websiteLang=ManageText::all();
            return view('user.blog.show',compact('blog','blogCategories','popularBlogs','commentSetting','banner_image','menus','default_profile_image','websiteLang'));
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return back()->with($notification);
        }

    }


        public function blogCategory($slug,Request $request){
            Paginator::useBootstrap();
            $category=BlogCategory::where(['slug'=>$slug,'status'=>1])->first();
            if(!$category){
                return back();
            }

            $paginator=CustomPaginator::where('id',1)->first()->qty;
            $blogs=Blog::where(['blog_category_id'=>$category->id,'status'=>1])->paginate($paginator);
            $blogs=$blogs->appends($request->all());
            $banner_image=BannerImage::find(5);
            $seo_text=SeoText::find(6);
            $menus=Navigation::all();
            $websiteLang=ManageText::all();
            return view('user.blog.index',compact('blogs','banner_image','menus','seo_text','websiteLang'));
        }

        public function blogSearch(Request $request){
            Paginator::useBootstrap();
            $rules = [
                'search'=>'required',
            ];


            $this->validate($request, $rules);
            $paginator=CustomPaginator::where('id',1)->first()->qty;
            $blogs=Blog::where('title','LIKE','%'.$request->search.'%')->paginate($paginator);
            $blogs=$blogs->appends($request->all());
            $seo_text=SeoText::find(6);
            $banner_image=BannerImage::find(5);
            $menus=Navigation::all();
            $websiteLang=ManageText::all();
            return view('user.blog.index',compact('blogs','seo_text','banner_image','menus','websiteLang'));
        }

        public function blogComment(Request $request,$blogId){

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
                'comment'=>'required',
                'g-recaptcha-response'=>new Captcha()
            ];
            $customMessages = [
                'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
                'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
                'comment.required' => $valid_lang->where('lang_key','comment')->first()->custom_text,
            ];
            $this->validate($request, $rules, $customMessages);

            $comment=new BlogComment();
            $comment->blog_id=$blogId;
            $comment->name=$request->name;
            $comment->email=$request->email;
            $comment->comment=$request->comment;
            $comment->save();


            $notification=array(
                'messege'=>'Commented Successufully',
                'alert-type'=>'success'
            );

        return back()->with($notification);
    }

    public function faq(){
        $faqs=Faq::where('status',1)->get();
        $banner_image=BannerImage::find(19);
        $faq_image=BannerImage::find(20);

        $seo_text=SeoText::find(8);
        $menus=Navigation::all();

        return view('user.faq',compact('banner_image','faqs','faq_image','seo_text','menus'));

    }


    public function contactUs(){
        $contact=ContactInformation::first();
        $contactSetting=Setting::first();
        $seo_text=SeoText::find(7);
        $banner_image=BannerImage::find(6);
        $menus=Navigation::all();
        $websiteLang=ManageText::all();
        return view('user.contact-us',compact('contact','contactSetting','seo_text','banner_image','menus','websiteLang'));
    }


    public function termsCondition(){
        $termsCondtion=ConditionPrivacy::first();
        $banner_image=BannerImage::find(9);
        $menus=Navigation::all();

        return view('user.terms-condition',compact('termsCondtion','banner_image','menus'));
    }



    public function privacyPolicy(){
        $termsCondtion=ConditionPrivacy::first();
        $banner_image=BannerImage::find(10);
        $menus=Navigation::all();
        return view('user.privacy-policy',compact('termsCondtion','banner_image','menus'));
    }



    // manage subsciber
    public function subscribeUs(Request $request){
        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required|email',
        ];
        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text
        ];
        $this->validate($request, $rules, $customMessages);


        $isSubsriber=Subscribe::where('email',$request->email)->count();
        if($isSubsriber ==0){
            $subscribe=Subscribe::create([
                'email'=>$request->email,
                'verify_token'=>Str::random(25)
            ]);

            MailHelper::setMailConfig();

            $template=EmailTemplate::where('id',4)->first();
            $message=$template->description;
            $subject=$template->subject;
            Mail::to($subscribe->email)->send(new SubscribeUsNotification($subscribe,$message,$subject));

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','subscribe')->first()->custom_text;
            return response()->json(['success'=>$notification]);
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','already_subscribe')->first()->custom_text;
            return response()->json(['error'=>$notification]);
        }

    }

    public function subscriptionVerify($token){
        $subscribe=Subscribe::where('verify_token',$token)->first();
        if($subscribe){
            $subscribe->status=1;
            $subscribe->verify_token=null;
            $subscribe->save();

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','verified')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return redirect()->to('/')->with($notification);
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','invalid_token')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return redirect()->to('/')->with($notification);
        }
    }


    public function customPage($slug){
        $page=CustomPage::where('slug',$slug)->first();
        if(!$page){
            return back();
        }
        $banner_image=BannerImage::find(17);
        $menus=Navigation::all();
        return view('user.custom-page',compact('page','banner_image','menus'));
    }


    public function agent(){
        Paginator::useBootstrap();
        $banner_image=BannerImage::find(21);
        $paginate_qty=CustomPaginator::where('id',3)->first()->qty;
        $agents=User::where('status',1)->orderBy('id','desc')->paginate($paginate_qty);
        $orders=Order::where(['status'=>1])->get();
        $default_profile_image=BannerImage::find(15);
        $seo_text=SeoText::find(5);
        $menus=Navigation::all();
        $websiteLang=ManageText::all();
        return view('user.agent.index',compact('banner_image','menus','agents','orders','default_profile_image','seo_text','websiteLang'));
    }

    public function agentDetails(Request $request){
        Paginator::useBootstrap();
        $user_type='';
        if(!$request->user_type){
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('home')->with($notification);
        }else{
            $user_type=$request->user_type;
        }


        if($user_type ==1 || $user_type ==2){
            if($request->user_name){
                if($user_type==1){

                    $user=Admin::where(['status'=>1,'slug'=>$request->user_name])->first();
                    if(!$user){
                        $notify_lang=NotificationText::all();
                        $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
                        $notification=array('messege'=>$notification,'alert-type'=>'error');
                        return redirect()->route('home')->with($notification);
                    }

                    $paginate_qty=CustomPaginator::where('id',2)->first()->qty;
                    $banner_image=BannerImage::find(1);
                    $default_image=BannerImage::find(18);
                    $menus=Navigation::all();
                    $currency=Setting::first();
                    $setting=Setting::first();
                    $properties=Property::where(['status'=>1,'admin_id'=>$user->id])->paginate($paginate_qty);
                    $popluarProperties=Property::where('status',1)->orderBy('views','desc')->get();
                    $properties=$properties->appends($request->all());

                    $default_profile_image=BannerImage::find(15);
                    $websiteLang=ManageText::all();
                    return view('user.agent.show',compact('properties','banner_image','default_image','menus','currency','user','setting','user_type','popluarProperties','default_profile_image','websiteLang'));

                }else{
                    $user=User::where(['status'=>1,'slug'=>$request->user_name])->first();
                    if(!$user){
                        $notify_lang=NotificationText::all();
                        $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
                        $notification=array('messege'=>$notification,'alert-type'=>'error');
                        return redirect()->route('home')->with($notification);
                    }

                    $paginate_qty=CustomPaginator::where('id',2)->first()->qty;
                    $banner_image=BannerImage::find(18);
                    $default_image=BannerImage::find(15);
                    $menus=Navigation::all();
                    $currency=Setting::first();
                    $setting=Setting::first();
                    $properties=Property::where(['status'=>1,'user_id'=>$user->id])->paginate($paginate_qty);
                    $properties=$properties->appends($request->all());
                    $popluarProperties=Property::where('status',1)->orderBy('views','desc')->get();
                    $default_profile_image=BannerImage::find(15);
                    $websiteLang=ManageText::all();
                    return view('user.agent.show',compact('properties','banner_image','default_image','menus','currency','user','setting','user_type','popluarProperties','default_profile_image','websiteLang'));
                }
            }else{
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
                $notification=array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->route('home')->with($notification);
            }
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('home')->with($notification);
        }
    }



    public function pricingPlan(){
        $packages=Package::where('status',1)->orderBy('package_order','asc')->get();
        $seo_text=SeoText::find(4);
        $banner_image=BannerImage::find(3);
        $menus=Navigation::all();
        $currency=Setting::first();
        $websiteLang=ManageText::all();
        return view('user.price-plan',compact('packages','seo_text','banner_image','menus','currency','websiteLang'));
    }


    public function properties(Request $request){
        Paginator::useBootstrap();
        // cheack page type, page type means grid view or listing view
        $page_type='';
        if(!$request->page_type){
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('home')->with($notification);
        }else{
            if($request->page_type=='list_view'){
                $page_type=$request->page_type;
            }else if($request->page_type=='grid_view'){
                $page_type=$request->page_type;
            }else{
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
                $notification=array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->route('home')->with($notification);
            }
        }
        // end page type


        $paginate_qty=CustomPaginator::where('id',2)->first()->qty;

        if($request->sorting_id){
            $id=$request->sorting_id;
            if($id==1){
                $properties=Property::where('status',1)->orderBy('id','desc')->paginate($paginate_qty);
            }else if($id==2){
                $properties=Property::where('status',1)->orderBy('views','desc')->paginate($paginate_qty);
            }else if($id==3){
                $properties=Property::where(['is_featured'=>1,'status'=>1])->orderBy('id','desc')->paginate($paginate_qty);
            }else if($id==4){
                $properties=Property::where(['top_property'=>1,'status'=>1])->orderBy('id','desc')->paginate($paginate_qty);
            }else if($id==5){
                $properties=Property::where(['status'=>1])->orderBy('id','desc')->paginate($paginate_qty);
            }else if($id==6){
                $properties=Property::where(['urgent_property'=>1,'status'=>1])->orderBy('id','desc')->paginate($paginate_qty);
            }else if($id==7){
                $properties=Property::where(['status'=>1])->orderBy('id','asc')->paginate($paginate_qty);
            }
        }else{
            $properties=Property::where('status',1)->orderBy('id','desc')->paginate($paginate_qty);
        }

        $properties=$properties->appends($request->all());

        $banner_image=BannerImage::find(1);
        $default_image=BannerImage::find(15);
        $menus=Navigation::all();
        $currency=Setting::first();
        $seo_text=SeoText::find(2);
        $propertyTypes=PropertyType::where('status',1)->orderBy('type','asc')->get();
        $cities=City::where('status',1)->orderBy('name','asc')->get();
        $aminities=Aminity::where('status',1)->orderBy('aminity','asc')->get();
        $websiteLang=ManageText::all();
        return view('user.property.index',compact('properties','banner_image','default_image','menus','currency','page_type','seo_text','propertyTypes','cities','aminities','websiteLang'));
    }


      public function downloadListingFile($file){
        $filepath= public_path() . "/uploads/custom-images/".$file;
        return response()->download($filepath);
    }

    public function propertDetails($slug){
        $property=Property::where(['status'=>1,'slug'=>$slug])->first();
        if($property){

            $isExpired=false;
            if($property->expired_date==null){
                $isExpired=false;
            }else if($property->expired_date >= date('Y-m-d')){
                $isExpired=false;
            }else{
                $isExpired=true;
            }
            if($isExpired){
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
                $notification=array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->back()->with($notification);
            }

            $property->views=$property->views +1;
            $property->save();
            $similarProperties=Property::where(['status'=>1,'property_type_id'=>$property->property_type_id])->where('id', '!=',$property->id)->get()->take(3);
            $banner_image=BannerImage::find(1);
            $default_image=BannerImage::find(15);
            $menus=Navigation::all();
            $currency=Setting::first();
            $setting=Setting::first();
            $websiteLang=ManageText::all();
            return view('user.property.show',compact('property','banner_image','default_image','menus','currency','setting','similarProperties','websiteLang'));
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
    }




    public function searchPropertyPage(Request $request){

        Paginator::useBootstrap();

        // check page type, page type means grid view or list view
        $page_type='';
        if(!$request->page_type){
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('home')->with($notification);
        }else{
            if($request->page_type=='list_view'){
                $page_type=$request->page_type;
            }else if($request->page_type=='grid_view'){
                $page_type=$request->page_type;
            }else{
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
                $notification=array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->route('home')->with($notification);
            }
        }
        // end page type

        // check aminity
        $sortArry=[];
        if($request->aminity){
            foreach($request->aminity as $amnty){
                array_push($sortArry,(int)$amnty);
            }
        }else{
            $aminities=Aminity::where('status',1)->get();
            foreach($aminities as $aminity){
                array_push($sortArry,(int)$aminity->id);
            }
        }
        // end aminity

        // soriting data
        $paginate_qty=CustomPaginator::where('id',2)->first()->qty;
        // check order type
        $orderBy="desc";
        $orderByView=false;
        if($request->sorting_id){
            if($request->sorting_id==7){
                $orderBy="asc";
            }else if($request->sorting_id==1){
                $orderBy="desc";
            }else if($request->sorting_id==5){
                $orderBy="desc";
            }else if($request->sorting_id==2){
                $orderBy="asc";
                $orderByView=true;
            }
        }
        // end check order type
        // start query
        $propertyAminities=PropertyAminity::whereHas('property',function($query) use ($request){
            if($request->property_type != null){
                $query->where(['property_type_id'=>$request->property_type,'status'=>1]);
            }
            if($request->city_id != null){
                $query->where(['city_id'=>$request->city_id,'status'=>1]);
            }
            if($request->search != null){
                $query->where('title','LIKE','%'.$request->search.'%')->where('status',1);
            }

            if($request->purpose_type != null){
                $query->where(['property_purpose_id'=>$request->purpose_type,'status'=>1]);
            }

            if($request->sorting_id){
                if($request->sorting_id==3){
                    $query->where(['is_featured'=>1,'status'=>1]);
                }else if($request->sorting_id==6){
                    $query->where(['urgent_property'=>1,'status'=>1]);
                }elseif($request->sorting_id==4){
                    $query->where(['top_property'=>1,'status'=>1]);
                }
            }

            $query->where(['status'=>1]);
        })->whereIn('aminity_id',$sortArry)
        ->select('property_id')->groupBy('property_id')
        ->orderBy('id',$orderBy)
        ->paginate($paginate_qty);




        // end query, sorting

        $propertyAminities=$propertyAminities->appends($request->all());



        $aminities=Aminity::where('status',1)->orderBy('aminity','asc')->get();
        $banner_image=BannerImage::find(1);
        $default_image=BannerImage::find(15);
        $menus=Navigation::all();
        $currency=Setting::first();
        $seo_text=SeoText::find(2);
        $propertyTypes=PropertyType::where('status',1)->orderBy('type','asc')->get();
        $cities=City::where('status',1)->orderBy('name','asc')->get();
        $websiteLang=ManageText::all();
        return view('user.property.search',compact('propertyAminities','aminities','seo_text','banner_image','menus','page_type','currency','propertyTypes','cities','websiteLang'));
    }


}
