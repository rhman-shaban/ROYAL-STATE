<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Package;
use App\Order;
use App\Setting;
use App\PaymentAccount;
use App\NotificationText;
use App\Navigation;
use App\ManageText;
use App\BannerImage;
use App\EmailTemplate;
use Carbon\Carbon;
use App\Mail\OrderConfirmation;
use Mail;
use Auth;
use Session;
Use Stripe;
use App\Listing;
use App\Property;
use App\Razorpay;
use App\Flutterwave;
use App\PaymongoPayment;
use App\Helpers\MailHelper;
use Str;
use Razorpay\Api\Api;
use Exception;
use App\PaystackAndMollie;
use App\InstamojoPayment;
use Redirect;
use Mollie\Laravel\Facades\Mollie;
class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }


    public function purchase($id){

        $package=Package::find($id);
        $user=Auth::guard('web')->user();;
        if($package){
            if($package->package_type==0){

                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );

                    return redirect()->back()->with($notification);
                }
                // end

                $setting=Setting::first();
                $activeOrder=Order::where(['user_id'=>$user->id,'status'=>1])->count();
                $oldOrders=Order::where('user_id',$user->id)->update(['status'=>0]);
                $order=new Order();
                $order->user_id=$user->id;
                $order->order_id='#'.rand(22,44).date('Ydmis');
                $order->package_id=$package->id;
                $order->purchase_date=date('Y-m-d');
                $order->expired_day=$package->number_of_days;
                $order->expired_date=date('Y-m-d', strtotime($package->number_of_days.' days'));
                $order->status=1;
                $order->payment_status=1;
                $order->amount_usd=0;
                $order->amount_real_currency=0;
                $order->currency_type=$setting->currency_name;
                $order->currency_icon=$setting->currency_icon;
                $order->save();

                // active and  in-active minimum limit listing
                $userProperties=Property::where('user_id',$user->id)->orderBy('id','desc')->get();
                if($userProperties->count() !=0){
                    if($package->number_of_property !=-1){
                        foreach($userProperties as $index => $listing){
                            if(++$index <= $package->number_of_property){
                                $listing->status=1;
                                $listing->save();
                            }else{
                                $listing->status=0;
                                $listing->save();
                            }
                        }
                    }elseif($package->number_of_property ==-1){
                        foreach($userProperties as $index => $listing){
                            $listing->status=1;
                            $listing->save();
                        }
                    }
                }
                // end inactive


                 // setup expired date
                if($userProperties->count() != 0){
                    foreach($userProperties as $index => $listing){
                        $listing->expired_date=$order->expired_date;
                        $listing->save();
                    }
                }


                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','order_success')->first()->custom_text;
                $notification=array('messege'=>$notification,'alert-type'=>'success');
                return redirect()->route('user.my-order')->with($notification);
            }else{

                $banner_image=BannerImage::find(12);
                $menus=Navigation::all();
                $currency=Setting::first();
                $setting=Setting::first();
                $stripe=PaymentAccount::first();
                $websiteLang=ManageText::all();
                $package_price=$package->price;
                $razorpay=Razorpay::first();
                $flutterwave=Flutterwave::first();
                $paymentSetting=$stripe;
                $paystack = PaystackAndMollie::first();
                $instamojo = InstamojoPayment::first();
                $paymongo = PaymongoPayment::first();
                $mollie = $paystack;
                return view('user.profile.payment',compact('banner_image','menus','currency','setting','stripe','package','websiteLang','package_price','razorpay','paymentSetting','flutterwave','user','paystack','instamojo','mollie','paymongo'));
            }
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return redirect()->route('pricing.plan')->with($notification);
        }


    }

    public function stripePayment(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // end

        $stripe=PaymentAccount::first();
        $currency=Setting::first();
        $package=Package::find($id);
        $user=Auth::guard('web')->user();
        if($package){
            Stripe\Stripe::setApiKey($stripe->stripe_secret);

            $setting=Setting::first();
            $amount_usd=round($package->price / $setting->currency_rate,2);
            $payableAmount = round($package->price * $stripe->stripe_currency_rate,2);

            $result=Stripe\Charge::create ([
                    "amount" =>$payableAmount * 100,
                    "currency" => $stripe->stripe_currency_code,
                    "source" => $request->stripeToken,
                    "description" => env('APP_NAME')
            ]);


            $activeOrder=Order::where(['user_id'=>$user->id,'status'=>1])->count();
            $oldOrders=Order::where('user_id',$user->id)->update(['status'=>0]);


            $order=new Order();
            $order->user_id=$user->id;
            $order->order_id='#'.rand(22,44).date('Ydmis');
            $order->package_id=$package->id;
            $order->purchase_date=date('Y-m-d');
            $order->expired_day=$package->number_of_days;
            $order->expired_date=$package->number_of_days ==-1 ? null : date('Y-m-d', strtotime($package->number_of_days.' days'));
            $order->payment_method="Stripe";
            $order->transaction_id=$result->balance_transaction;
            $order->payment_status=1;
            $order->amount_usd=$amount_usd;
            $order->amount_real_currency=$package->price;
            $order->currency_type=$setting->currency_name;
            $order->currency_icon=$setting->currency_icon;
            $order->status=1;
            $order->save();

            // active and  in-active minimum limit listing
            $userProperties=Property::where('user_id',$user->id)->orderBy('id','desc')->get();
            if($userProperties->count() !=0){
                if($package->number_of_property !=-1){
                    foreach($userProperties as $index => $listing){
                        if(++$index <= $package->number_of_property){
                            $listing->status=1;
                            $listing->save();
                        }else{
                            $listing->status=0;
                            $listing->save();
                        }
                    }
                }elseif($package->number_of_property ==-1){
                    foreach($userProperties as $index => $listing){
                        $listing->status=1;
                        $listing->save();
                    }
                }
            }
            // end inactive

            // setup expired date
            if($userProperties->count() != 0){
                foreach($userProperties as $index => $listing){
                    $listing->expired_date=$order->expired_date;
                    $listing->save();
                }
            }


            MailHelper::setMailConfig();


            $order_details='Purchase Date: '.$order->purchase_date.'<br>';
            $order_details .='Expired Date: '.$order->expired_date;

            // send email
            $template=EmailTemplate::where('id',6)->first();
            $message=$template->description;
            $subject=$template->subject;
            $message=str_replace('{{user_name}}',$user->name,$message);
            $message=str_replace('{{payment_method}}','Stripe',$message);
            $total_amount=$currency->currency_icon. $package->price;
            $message=str_replace('{{amount}}',$total_amount,$message);
            $message=str_replace('{{order_details}}',$order_details,$message);
            Mail::to($user->email)->send(new OrderConfirmation($message,$subject));



            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','order_success')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('user.my-order')->with($notification);

        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return redirect()->route('pricing.plan')->with($notification);
        }



    }

    public function bankPayment(Request $request){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'tran_id'=>'required'
        ]);


        $stripe=PaymentAccount::first();
        $currency=Setting::first();
        $setting=Setting::first();
        $package=Package::find($request->package_id);
        $user=Auth::guard('web')->user();
        $amount_usd=round($package->price / $setting->currency_rate,2);
        if($package){
            $order=new Order();
            $order->user_id=$user->id;
            $order->order_id='#'.rand(22,44).date('Ydmis');
            $order->package_id=$package->id;
            $order->purchase_date=date('Y-m-d');
            $order->expired_day=$package->number_of_days;
            $order->expired_date=$package->number_of_days ==-1 ? null : date('Y-m-d', strtotime($package->number_of_days.' days'));
            $order->payment_method="Bank Payment";
            $order->transaction_id=$request->tran_id;
            $order->payment_status=0;
            $order->amount_usd=$amount_usd;
            $order->amount_real_currency=$package->price;
            $order->currency_type=$setting->currency_name;
            $order->currency_icon=$setting->currency_icon;
            $order->status=0;
            $order->save();

            MailHelper::setMailConfig();

            $order_details='Purchase Date: '.$order->purchase_date.'<br>';
            $order_details .='Expired Date: '.$order->expired_date;

            // send email
            $template=EmailTemplate::where('id',6)->first();
            $message=$template->description;
            $subject=$template->subject;
            $message=str_replace('{{user_name}}',$user->name,$message);
            $message=str_replace('{{payment_method}}','Bank Payment',$message);
            $total_amount=$currency->currency_icon. $package->price;
            $message=str_replace('{{amount}}',$total_amount,$message);
            $message=str_replace('{{order_details}}',$order_details,$message);
            Mail::to($user->email)->send(new OrderConfirmation($message,$subject));

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','bank_order_success')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('user.my-order')->with($notification);

        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return redirect()->route('pricing.plan')->with($notification);
        }


    }


    public function razorPay(Request $request,$id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $razorpay=Razorpay::first();
        $input = $request->all();
        $api = new Api($razorpay->razorpay_key,$razorpay->secret_key);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                $payId=$response->id;
                $currency=Setting::first();
                $package=Package::find($id);
                $user=Auth::guard('web')->user();
                if($package){

                    $setting=Setting::first();
                    $amount_usd=round($package->price / $setting->currency_rate,2);

                    $activeOrder=Order::where(['user_id'=>$user->id,'status'=>1])->count();
                    $oldOrders=Order::where('user_id',$user->id)->update(['status'=>0]);

                    $order=new Order();
                    $order->user_id=$user->id;
                    $order->order_id='#'.rand(22,44).date('Ydmis');
                    $order->package_id=$package->id;
                    $order->purchase_date=date('Y-m-d');
                    $order->expired_day=$package->number_of_days;
                    $order->expired_date=$package->number_of_days ==-1 ? null : date('Y-m-d', strtotime($package->number_of_days.' days'));
                    $order->payment_method="RazorPay";
                    $order->transaction_id=$payId;
                    $order->payment_status=1;
                    $order->amount_usd=$amount_usd;
                    $order->amount_real_currency=$package->price;
                    $order->currency_type=$setting->currency_name;
                    $order->currency_icon=$setting->currency_icon;
                    $order->status=1;
                    $order->save();

                    // active and  in-active minimum limit listing
                    $userProperties=Property::where('user_id',$user->id)->orderBy('id','desc')->get();
                    if($userProperties->count() !=0){
                        if($package->number_of_property !=-1){
                            foreach($userProperties as $index => $listing){
                                if(++$index <= $package->number_of_property){
                                    $listing->status=1;
                                    $listing->save();
                                }else{
                                    $listing->status=0;
                                    $listing->save();
                                }
                            }
                        }elseif($package->number_of_property ==-1){
                            foreach($userProperties as $index => $listing){
                                $listing->status=1;
                                $listing->save();
                            }
                        }
                    }
                    // end inactive

                    // setup expired date
                    if($userProperties->count() != 0){
                        foreach($userProperties as $index => $listing){
                            $listing->expired_date=$order->expired_date;
                            $listing->save();
                        }
                    }

                    MailHelper::setMailConfig();

                    $order_details='Purchase Date: '.$order->purchase_date.'<br>';
                    $order_details .='Expired Date: '.$order->expired_date;

                    // send email
                    $template=EmailTemplate::where('id',6)->first();
                    $message=$template->description;
                    $subject=$template->subject;
                    $message=str_replace('{{user_name}}',$user->name,$message);
                    $message=str_replace('{{payment_method}}','RazorPay',$message);
                    $total_amount=$currency->currency_icon. $package->price;
                    $message=str_replace('{{amount}}',$total_amount,$message);
                    $message=str_replace('{{order_details}}',$order_details,$message);
                    Mail::to($user->email)->send(new OrderConfirmation($message,$subject));

                    $notify_lang=NotificationText::all();
                    $notification=$notify_lang->where('lang_key','order_success')->first()->custom_text;
                    $notification=array('messege'=>$notification,'alert-type'=>'success');
                    return redirect()->route('user.my-order')->with($notification);

                }else{
                    $notify_lang=NotificationText::all();
                    $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
                    $notification=array('messege'=>$notification,'alert-type'=>'error');

                    return redirect()->route('pricing.plan')->with($notification);
                }

            } catch (Exception $e) {
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
                $notification=array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->back()->with($notification);
            }
        }
        return "payment success";
    }

    public function flutterWavePayment(Request $request){
        $flutterwave=Flutterwave::first();
        $curl = curl_init();
        $tnx_id = $request->tnx_id;
        $url = "https://api.flutterwave.com/v3/transactions/$tnx_id/verify";
        $token = $flutterwave->secret_key;
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer $token"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        if($response->status == 'success'){
            $currency=Setting::first();
            $package=Package::find($request->package_id);
            $user=Auth::guard('web')->user();
            $setting=Setting::first();
            $amount_usd=round($package->price / $setting->currency_rate,2);

            $activeOrder=Order::where(['user_id'=>$user->id,'status'=>1])->count();
            $oldOrders=Order::where('user_id',$user->id)->update(['status'=>0]);


            $order=new Order();
            $order->user_id=$user->id;
            $order->order_id='#'.rand(22,44).date('Ydmis');
            $order->package_id=$package->id;
            $order->purchase_date=date('Y-m-d');
            $order->expired_day=$package->number_of_days;
            $order->expired_date=$package->number_of_days ==-1 ? null : date('Y-m-d', strtotime($package->number_of_days.' days'));
            $order->payment_method="Flutterwave";
            $order->transaction_id=$tnx_id;
            $order->payment_status=1;
            $order->amount_usd=$amount_usd;
            $order->amount_real_currency=$package->price;
            $order->currency_type=$setting->currency_name;
            $order->currency_icon=$setting->currency_icon;
            $order->status=1;
            $order->save();

            // active and  in-active minimum limit listing
            $userProperties=Property::where('user_id',$user->id)->orderBy('id','desc')->get();
            if($userProperties->count() !=0){
                if($package->number_of_property !=-1){
                    foreach($userProperties as $index => $listing){
                        if(++$index <= $package->number_of_property){
                            $listing->status=1;
                            $listing->save();
                        }else{
                            $listing->status=0;
                            $listing->save();
                        }
                    }
                }elseif($package->number_of_property ==-1){
                    foreach($userProperties as $index => $listing){
                        $listing->status=1;
                        $listing->save();
                    }
                }
            }
            // end inactive

            // setup expired date
            if($userProperties->count() != 0){
                foreach($userProperties as $index => $listing){
                    $listing->expired_date=$order->expired_date;
                    $listing->save();
                }
            }


            MailHelper::setMailConfig();

            $order_details='Purchase Date: '.$order->purchase_date.'<br>';
            $order_details .='Expired Date: '.$order->expired_date;

            // send email
            $template=EmailTemplate::where('id',6)->first();
            $message=$template->description;
            $subject=$template->subject;
            $message=str_replace('{{user_name}}',$user->name,$message);
            $message=str_replace('{{payment_method}}','Flutterwave',$message);
            $total_amount=$currency->currency_icon. $package->price;
            $message=str_replace('{{amount}}',$total_amount,$message);
            $message=str_replace('{{order_details}}',$order_details,$message);
            Mail::to($user->email)->send(new OrderConfirmation($message,$subject));

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','order_success')->first()->custom_text;
            return response()->json(['status' => 'success' , 'message' => $notification]);
        }else{
            $notify_lang = NotificationText::all();
            $notification = $notify_lang->where('lang_key','something')->first()->custom_text;
            return response()->json(['status' => 'faild' , 'message' => $notification]);
        }
    }


    public function paystackPayment(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // end

        $paystack = PaystackAndMollie::first();

        $reference = $request->reference;
        $transaction = $request->tnx_id;
        $secret_key = $paystack->paystack_secret_key;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST =>0,
            CURLOPT_SSL_VERIFYPEER =>0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $secret_key",
                "Cache-Control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $final_data = json_decode($response);
        if($final_data->status == true) {

            $currency=Setting::first();
            $package=Package::find($request->package_id);
            $user=Auth::guard('web')->user();
            $setting=Setting::first();

            $amount_usd=round($package->price / $setting->currency_rate,2);

            $activeOrder=Order::where(['user_id'=>$user->id,'status'=>1])->count();
            $oldOrders=Order::where('user_id',$user->id)->update(['status'=>0]);


            $order=new Order();
            $order->user_id=$user->id;
            $order->order_id='#'.rand(22,44).date('Ydmis');
            $order->package_id=$package->id;
            $order->purchase_date=date('Y-m-d');
            $order->expired_day=$package->number_of_days;
            $order->expired_date=$package->number_of_days ==-1 ? null : date('Y-m-d', strtotime($package->number_of_days.' days'));
            $order->payment_method="Paystack";
            $order->transaction_id=$transaction;
            $order->payment_status=1;
            $order->amount_usd=$amount_usd;
            $order->amount_real_currency=$package->price;
            $order->currency_type=$setting->currency_name;
            $order->currency_icon=$setting->currency_icon;
            $order->status=1;
            $order->save();

            // active and  in-active minimum limit listing
            $userProperties=Property::where('user_id',$user->id)->orderBy('id','desc')->get();
            if($userProperties->count() !=0){
                if($package->number_of_property !=-1){
                    foreach($userProperties as $index => $listing){
                        if(++$index <= $package->number_of_property){
                            $listing->status=1;
                            $listing->save();
                        }else{
                            $listing->status=0;
                            $listing->save();
                        }
                    }
                }elseif($package->number_of_property ==-1){
                    foreach($userProperties as $index => $listing){
                        $listing->status=1;
                        $listing->save();
                    }
                }
            }
            // end inactive

            // setup expired date
            if($userProperties->count() != 0){
                foreach($userProperties as $index => $listing){
                    $listing->expired_date=$order->expired_date;
                    $listing->save();
                }
            }


            MailHelper::setMailConfig();

            $order_details='Purchase Date: '.$order->purchase_date.'<br>';
            $order_details .='Expired Date: '.$order->expired_date;

            // send email
            $template=EmailTemplate::where('id',6)->first();
            $message=$template->description;
            $subject=$template->subject;
            $message=str_replace('{{user_name}}',$user->name,$message);
            $message=str_replace('{{payment_method}}','Paystack',$message);
            $total_amount=$currency->currency_icon. $package->price;
            $message=str_replace('{{amount}}',$total_amount,$message);
            $message=str_replace('{{order_details}}',$order_details,$message);
            Mail::to($user->email)->send(new OrderConfirmation($message,$subject));

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','order_success')->first()->custom_text;
            return response()->json(['status' => 'success' , 'message' => $notification]);
        }
    }

    public function molliePayment($id){
        $mollie = PaystackAndMollie::first();
        $package=Package::find($id);
        $user=Auth::guard('web')->user();
        $payableAmount = round($package->price * $mollie->mollie_currency_rate);

        $payableAmount= number_format($payableAmount, 2);
        $mollie_api_key = $mollie->mollie_key;
        $currency = strtoupper($mollie->mollie_currency_code);
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $currency,
                'value' => ''.$payableAmount.'',
            ],
            'description' => env('APP_NAME'),
            'redirectUrl' => route('user.mollie-payment-success'),
        ]);


        $payment = Mollie::api()->payments()->get($payment->id);
        session()->put('payment_id',$payment->id);
        session()->put('package_id',$id);
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function molliePaymentSuccess(Request $request){

        $mollie = PaystackAndMollie::first();
        $mollie_api_key = $mollie->mollie_key;
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments->get(session()->get('payment_id'));
        if ($payment->isPaid()){
            $package_id = Session::get('package_id');
            $payment_id = Session::get('payment_id');
            $package=Package::find($package_id);
            $user=Auth::guard('web')->user();
            $setting = Setting::first();
            $currency = $setting;

            $amount_usd=round($package->price / $setting->currency_rate,2);

            $activeOrder=Order::where(['user_id'=>$user->id,'status'=>1])->count();
            $oldOrders=Order::where('user_id',$user->id)->update(['status'=>0]);


            $order=new Order();
            $order->user_id=$user->id;
            $order->order_id='#'.rand(22,44).date('Ydmis');
            $order->package_id=$package->id;
            $order->purchase_date=date('Y-m-d');
            $order->expired_day=$package->number_of_days;
            $order->expired_date=$package->number_of_days ==-1 ? null : date('Y-m-d', strtotime($package->number_of_days.' days'));
            $order->payment_method="Mollie";
            $order->transaction_id=$payment_id;
            $order->payment_status=1;
            $order->amount_usd=$amount_usd;
            $order->amount_real_currency=$package->price;
            $order->currency_type=$setting->currency_name;
            $order->currency_icon=$setting->currency_icon;
            $order->status=1;
            $order->save();

            // active and  in-active minimum limit listing
            $userProperties=Property::where('user_id',$user->id)->orderBy('id','desc')->get();
            if($userProperties->count() !=0){
                if($package->number_of_property !=-1){
                    foreach($userProperties as $index => $listing){
                        if(++$index <= $package->number_of_property){
                            $listing->status=1;
                            $listing->save();
                        }else{
                            $listing->status=0;
                            $listing->save();
                        }
                    }
                }elseif($package->number_of_property ==-1){
                    foreach($userProperties as $index => $listing){
                        $listing->status=1;
                        $listing->save();
                    }
                }
            }
            // end inactive

            // setup expired date
            if($userProperties->count() != 0){
                foreach($userProperties as $index => $listing){
                    $listing->expired_date=$order->expired_date;
                    $listing->save();
                }
            }


            MailHelper::setMailConfig();


            $order_details='Purchase Date: '.$order->purchase_date.'<br>';
            $order_details .='Expired Date: '.$order->expired_date;

            // send email
            $template=EmailTemplate::where('id',6)->first();
            $message=$template->description;
            $subject=$template->subject;
            $message=str_replace('{{user_name}}',$user->name,$message);
            $message=str_replace('{{payment_method}}','Mollie',$message);
            $total_amount=$currency->currency_icon. $package->price;
            $message=str_replace('{{amount}}',$total_amount,$message);
            $message=str_replace('{{order_details}}',$order_details,$message);
            Mail::to($user->email)->send(new OrderConfirmation($message,$subject));



            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','order_success')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('user.my-order')->with($notification);


        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return redirect()->route('pricing.plan')->with($notification);
        }
    }


    public function payWithInstamojo($id){

        $instamojoPayment = InstamojoPayment::first();
        $package=Package::find($id);
        $user=Auth::guard('web')->user();
        $payableAmount = round($package->price * $instamojoPayment->currency_rate);
        $setting = Setting::first();
        $price = $payableAmount;

        $environment = $instamojoPayment->account_mode;
        $api_key = $instamojoPayment->api_key;
        $auth_token = $instamojoPayment->auth_token;

        if($environment == 'Sandbox') {
            $url = 'https://test.instamojo.com/api/1.1/';
        } else {
            $url = 'https://www.instamojo.com/api/1.1/';
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url.'payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:$api_key",
                "X-Auth-Token:$auth_token"));
        $payload = Array(
            'purpose' => env("APP_NAME"),
            'amount' => $price,
            'phone' => '918160651749',
            'buyer_name' => Auth::user()->name,
            'redirect_url' => route('user.instamojo-response'),
            'send_email' => true,
            'webhook' => 'http://www.example.com/webhook/',
            'send_sms' => true,
            'email' => Auth::user()->email,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        session()->put('package_id',$id);
        return redirect($response->payment_request->longurl);
    }

    public function instamojoResponse(Request $request){

        $input = $request->all();

        $instamojoPayment = InstamojoPayment::first();
        $environment = $instamojoPayment->account_mode;
        $api_key = $instamojoPayment->api_key;
        $auth_token = $instamojoPayment->auth_token;

        if($environment == 'Sandbox') {
            $url = 'https://test.instamojo.com/api/1.1/';
        } else {
            $url = 'https://www.instamojo.com/api/1.1/';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url.'payments/'.$request->get('payment_id'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:$api_key",
                "X-Auth-Token:$auth_token"));
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            $notification = trans('user_validation.Payment Faild');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('user.checkout.payment')->with($notification);
        } else {
            $data = json_decode($response);
        }

        if($data->success == true) {
            if($data->payment->status == 'Credit') {
                $package_id = Session::get('package_id');
                $payment_id = Session::get('payment_id');
                $package=Package::find($package_id);
                $user=Auth::guard('web')->user();
                $setting = Setting::first();
                $currency = $setting;
                $instamojoPayment = InstamojoPayment::first();

                $amount_usd=round($package->price / $setting->currency_rate,2);

                $activeOrder=Order::where(['user_id'=>$user->id,'status'=>1])->count();
                $oldOrders=Order::where('user_id',$user->id)->update(['status'=>0]);


                $order=new Order();
                $order->user_id=$user->id;
                $order->order_id='#'.rand(22,44).date('Ydmis');
                $order->package_id=$package->id;
                $order->purchase_date=date('Y-m-d');
                $order->expired_day=$package->number_of_days;
                $order->expired_date=$package->number_of_days ==-1 ? null : date('Y-m-d', strtotime($package->number_of_days.' days'));
                $order->payment_method="Instamojo";
                $order->transaction_id=$request->payment_id;
                $order->payment_status=1;
                $order->amount_usd=$amount_usd;
                $order->amount_real_currency=$package->price;
                $order->currency_type=$setting->currency_name;
                $order->currency_icon=$setting->currency_icon;
                $order->status=1;
                $order->save();

                // active and  in-active minimum limit listing
                $userProperties=Property::where('user_id',$user->id)->orderBy('id','desc')->get();
                if($userProperties->count() !=0){
                    if($package->number_of_property !=-1){
                        foreach($userProperties as $index => $listing){
                            if(++$index <= $package->number_of_property){
                                $listing->status=1;
                                $listing->save();
                            }else{
                                $listing->status=0;
                                $listing->save();
                            }
                        }
                    }elseif($package->number_of_property ==-1){
                        foreach($userProperties as $index => $listing){
                            $listing->status=1;
                            $listing->save();
                        }
                    }
                }
                // end inactive

                // setup expired date
                if($userProperties->count() != 0){
                    foreach($userProperties as $index => $listing){
                        $listing->expired_date=$order->expired_date;
                        $listing->save();
                    }
                }


                MailHelper::setMailConfig();


                $order_details='Purchase Date: '.$order->purchase_date.'<br>';
                $order_details .='Expired Date: '.$order->expired_date;

                // send email
                $template=EmailTemplate::where('id',6)->first();
                $message=$template->description;
                $subject=$template->subject;
                $message=str_replace('{{user_name}}',$user->name,$message);
                $message=str_replace('{{payment_method}}','Instamojo',$message);
                $total_amount=$currency->currency_icon. $package->price;
                $message=str_replace('{{amount}}',$total_amount,$message);
                $message=str_replace('{{order_details}}',$order_details,$message);
                Mail::to($user->email)->send(new OrderConfirmation($message,$subject));

                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','order_success')->first()->custom_text;
                $notification=array('messege'=>$notification,'alert-type'=>'success');
                return redirect()->route('user.my-order')->with($notification);

            }
        }

    }


    public function payWithPaymongo(Request $request, $id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // end

        $stripe=PaymentAccount::first();
        $currency=Setting::first();
        $package=Package::find($id);
        $user=Auth::guard('web')->user();
        if($package){
            $total_price = $package->price;
            $paymongoPayment = PaymongoPayment::first();
            $price = $total_price * $paymongoPayment->currency_rate;
            $price = round($price);
            $currency_code = $paymongoPayment->currency_code;
            $setting=Setting::first();
            $amount_usd=round($package->price / $setting->currency_rate,2);

            // create payment method
            require_once('vendor/autoload.php');
            $client = new \GuzzleHttp\Client();
            $card_number = $request->card_number;
            $cvc = $request->cvc;
            $month = $request->month;
            $year = $request->year;
            $code = base64_encode($paymongoPayment->public_key.':'.$paymongoPayment->secret_key);

            try{
                $response = $client->request('POST', 'https://api.paymongo.com/v1/payment_methods', [
                    'body' => '{"data":{"attributes":{"details":{"card_number":"'.$card_number.'","exp_month":'.$month.',"exp_year":'.$year.',"cvc":"'.$cvc.'"},"type":"card"}}}',
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Basic '.$code.'',
                        'Content-Type' => 'application/json',
                    ],
                ]);

            }catch (Exception $e) {
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','valid_card')->first()->custom_text;
                $notification=array('messege'=>$notification,'alert-type'=>'error');

                return redirect()->back()->with($notification);
            }

            $response = json_decode($response->getBody(), true);
            $payment_method_id = $response['data']['id'];

            if($price < 100){
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','amont_100')->first()->custom_text;
                $notification=array('messege'=>$notification,'alert-type'=>'error');

                return redirect()->back()->with($notification);
            }

            $price = $price * 100;

            // create payment instant
            $client = new \GuzzleHttp\Client();
            $secret_code = base64_encode($paymongoPayment->secret_key);
            $response = $client->request('POST', 'https://api.paymongo.com/v1/payment_intents', [
            'body' => '{"data":{"attributes":{"amount":'.$price.',"payment_method_allowed":["card"],"payment_method_options":{"card":{"request_three_d_secure":"any"}},"currency":"'.$currency_code.'","capture_type":"automatic"}}}',
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic '.$secret_code.'',
                'Content-Type' => 'application/json',
            ],
            ]);

            $intent_response = json_decode($response->getBody(), true);
            $intent_client_key = $intent_response['data']['attributes']['client_key'];
            $intent_id = $intent_response['data']['id'];

            $client = new \GuzzleHttp\Client();

            // create payment
            $payment_response = $client->request('POST', 'https://api.paymongo.com/v1/payment_intents/'.$intent_id.'/attach', [
            'body' => '{"data":{"attributes":{"payment_method":"'.$payment_method_id.'","client_key":"'.$intent_client_key.'"}}}',
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic '.$secret_code.'',
                'Content-Type' => 'application/json',
            ],
            ]);

            $payment_response = json_decode($response->getBody(), true);

            if($payment_response['data']['attributes']['status'] != 'faild'){
                $activeOrder=Order::where(['user_id'=>$user->id,'status'=>1])->count();
                $oldOrders=Order::where('user_id',$user->id)->update(['status'=>0]);


                $order=new Order();
                $order->user_id=$user->id;
                $order->order_id='#'.rand(22,44).date('Ydmis');
                $order->package_id=$package->id;
                $order->purchase_date=date('Y-m-d');
                $order->expired_day=$package->number_of_days;
                $order->expired_date=$package->number_of_days ==-1 ? null : date('Y-m-d', strtotime($package->number_of_days.' days'));
                $order->payment_method="Paymongo";
                $order->transaction_id=$payment_response['data']['id'];
                $order->payment_status=1;
                $order->amount_usd=$amount_usd;
                $order->amount_real_currency=$package->price;
                $order->currency_type=$setting->currency_name;
                $order->currency_icon=$setting->currency_icon;
                $order->status=1;
                $order->save();

                // active and  in-active minimum limit listing
                $userProperties=Property::where('user_id',$user->id)->orderBy('id','desc')->get();
                if($userProperties->count() !=0){
                    if($package->number_of_property !=-1){
                        foreach($userProperties as $index => $listing){
                            if(++$index <= $package->number_of_property){
                                $listing->status=1;
                                $listing->save();
                            }else{
                                $listing->status=0;
                                $listing->save();
                            }
                        }
                    }elseif($package->number_of_property ==-1){
                        foreach($userProperties as $index => $listing){
                            $listing->status=1;
                            $listing->save();
                        }
                    }
                }
                // end inactive

                // setup expired date
                if($userProperties->count() != 0){
                    foreach($userProperties as $index => $listing){
                        $listing->expired_date=$order->expired_date;
                        $listing->save();
                    }
                }


                MailHelper::setMailConfig();


                $order_details='Purchase Date: '.$order->purchase_date.'<br>';
                $order_details .='Expired Date: '.$order->expired_date;

                // send email
                $template=EmailTemplate::where('id',6)->first();
                $message=$template->description;
                $subject=$template->subject;
                $message=str_replace('{{user_name}}',$user->name,$message);
                $message=str_replace('{{payment_method}}','Paymongo',$message);
                $total_amount=$currency->currency_icon. $package->price;
                $message=str_replace('{{amount}}',$total_amount,$message);
                $message=str_replace('{{order_details}}',$order_details,$message);
                Mail::to($user->email)->send(new OrderConfirmation($message,$subject));



                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','order_success')->first()->custom_text;
                $notification=array('messege'=>$notification,'alert-type'=>'success');
                return redirect()->route('user.my-order')->with($notification);
            }else{
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
                $notification=array('messege'=>$notification,'alert-type'=>'error');

                return redirect()->back()->with($notification);
            }


        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return redirect()->route('pricing.plan')->with($notification);
        }
    }


    public function payWithPaymongoGrabPay($id){
        $package=Package::find($id);
        $user=Auth::guard('web')->user();
        $total_price = $package->price;
        $paymongoPayment = PaymongoPayment::first();
        $price = $total_price * $paymongoPayment->currency_rate;
        $price = round($price);
        $success_url = route('user.paymongo-payment-success');
        $faild_url = route('user.paymongo-payment-cancled');
        $currency_code = $paymongoPayment->currency_code;

        if($price < 100){
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','amont_100')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return redirect()->back()->with($notification);
        }

        $price = $price * 100;

        require_once('vendor/autoload.php');
        $code = base64_encode($paymongoPayment->public_key.':'.$paymongoPayment->secret_key);
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.paymongo.com/v1/sources', [
        'body' => '{"data":{"attributes":{"amount":'.$price.',"redirect":{"success":"'.$success_url.'","failed":"'.$faild_url.'"},"type":"grab_pay","currency":"'.$currency_code.'"}}}',
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Basic '.$code.'',
            'Content-Type' => 'application/json',
        ],
        ]);
        $response = json_decode($response->getBody(), true);
        session()->put('payment_id',$response['data']['id']);
        session()->put('package_id',$id);
        return redirect()->to($response['data']['attributes']['redirect']['checkout_url']);
    }

    public function payWithPaymongoGcash($id){
        $package=Package::find($id);
        $user=Auth::guard('web')->user();
        $total_price = $package->price;
        $paymongoPayment = PaymongoPayment::first();
        $price = $total_price * $paymongoPayment->currency_rate;
        $price = round($price);
        $success_url = route('user.paymongo-payment-success');
        $faild_url = route('user.paymongo-payment-cancled');
        $currency_code = $paymongoPayment->currency_code;

        if($price < 100){
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','amont_100')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return redirect()->back()->with($notification);
        }

        $price = $price * 100;

        require_once('vendor/autoload.php');
        $code = base64_encode($paymongoPayment->public_key.':'.$paymongoPayment->secret_key);
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.paymongo.com/v1/sources', [
        'body' => '{"data":{"attributes":{"amount":'.$price.',"redirect":{"success":"'.$success_url.'","failed":"'.$faild_url.'"},"type":"gcash","currency":"'.$currency_code.'"}}}',
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Basic '.$code.'',
            'Content-Type' => 'application/json',
        ],
        ]);
        $response = json_decode($response->getBody(), true);
        session()->put('payment_id',$response['data']['id']);
        session()->put('package_id',$id);
        return redirect()->to($response['data']['attributes']['redirect']['checkout_url']);
    }

    public function paymongoPaymentSuccess(Request $request){
        $package_id = Session::get('package_id');
        $payment_id = Session::get('payment_id');
        $package=Package::find($package_id);
        $user=Auth::guard('web')->user();
        $setting = Setting::first();
        $currency = $setting;

        $amount_usd=round($package->price / $setting->currency_rate,2);
        $activeOrder=Order::where(['user_id'=>$user->id,'status'=>1])->count();
        $oldOrders=Order::where('user_id',$user->id)->update(['status'=>0]);

        $order=new Order();
        $order->user_id=$user->id;
        $order->order_id='#'.rand(22,44).date('Ydmis');
        $order->package_id=$package->id;
        $order->purchase_date=date('Y-m-d');
        $order->expired_day=$package->number_of_days;
        $order->expired_date=$package->number_of_days ==-1 ? null : date('Y-m-d', strtotime($package->number_of_days.' days'));
        $order->payment_method="Paymongo";
        $order->transaction_id=$payment_id;
        $order->payment_status=1;
        $order->amount_usd=$amount_usd;
        $order->amount_real_currency=$package->price;
        $order->currency_type=$setting->currency_name;
        $order->currency_icon=$setting->currency_icon;
        $order->status=1;
        $order->save();

        // active and  in-active minimum limit listing
        $userProperties=Property::where('user_id',$user->id)->orderBy('id','desc')->get();
        if($userProperties->count() !=0){
            if($package->number_of_property !=-1){
                foreach($userProperties as $index => $listing){
                    if(++$index <= $package->number_of_property){
                        $listing->status=1;
                        $listing->save();
                    }else{
                        $listing->status=0;
                        $listing->save();
                    }
                }
            }elseif($package->number_of_property ==-1){
                foreach($userProperties as $index => $listing){
                    $listing->status=1;
                    $listing->save();
                }
            }
        }
        // end inactive

        // setup expired date
        if($userProperties->count() != 0){
            foreach($userProperties as $index => $listing){
                $listing->expired_date=$order->expired_date;
                $listing->save();
            }
        }

        MailHelper::setMailConfig();

        $order_details='Purchase Date: '.$order->purchase_date.'<br>';
        $order_details .='Expired Date: '.$order->expired_date;

        // send email
        $template=EmailTemplate::where('id',6)->first();
        $message=$template->description;
        $subject=$template->subject;
        $message=str_replace('{{user_name}}',$user->name,$message);
        $message=str_replace('{{payment_method}}','Paymongo',$message);
        $total_amount=$currency->currency_icon. $package->price;
        $message=str_replace('{{amount}}',$total_amount,$message);
        $message=str_replace('{{order_details}}',$order_details,$message);
        Mail::to($user->email)->send(new OrderConfirmation($message,$subject));

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','order_success')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('user.my-order')->with($notification);

    }
    public function paymongoPaymentCancled(Request $request){
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','payment_faild')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'error');

        return redirect()->route('pricing.plan')->with($notification);
    }
}
