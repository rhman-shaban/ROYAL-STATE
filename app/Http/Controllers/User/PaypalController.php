<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\PaymentExecution;
use Cart;
use App\Order;
use Auth;
use App\PaymentAccount;
use App\Setting;
use App\Mail\OrderConfirmation;
use Mail;
use App\EmailTemplate;
use App\ListingPackage;
use App\NotificationText;
use App\Listing;
use App\Property;
use App\Package;
use Session;

use App\Helpers\MailHelper;
class PaypalController extends Controller
{
    private $apiContext;
    public function __construct()
    {
        $account=PaymentAccount::first();
    /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->apiContext = new ApiContext(new OAuthTokenCredential(
            $account->paypal_client_id,
            $account->paypal_secret,
            )
        );

        $setting=array(
            'mode' => $account->account_mode,
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path() . '/logs/paypal.log',
            'log.LogLevel' => 'ERROR'
        );
        $this->apiContext->setConfig($setting);
    }
    public function paypal(){
        return view('paypal');
    }

    public function store($id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // end

        $package=Package::find($id);
        if(!$package){
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return redirect()->route('pricing.plan')->with($notification);
        }


        Session::put('listing_package_id',$id);

        $price=$package->price;

        $setting=Setting::first();
        $paypalSetting=PaymentAccount::first();
        $amount_usd=round($package->price / $setting->currency_rate,2);
        $payableAmount= round($package->price * $paypalSetting->paypal_currency_rate,2);
        $name=env('APP_NAME');

        // set payer
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $currency=Setting::first();
        // set amount total
        $amount = new Amount();
        $amount->setCurrency($paypalSetting->paypal_currency_code)
            ->setTotal($payableAmount);

        // transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription(env('APP_NAME'));


        // redirect url
        $redirectUrls = new RedirectUrls();

        $root_url=url('/');
        $redirectUrls->setReturnUrl($root_url."/user/paypal-payment-success")
            ->setCancelUrl($root_url."/user/paypal-payment-cancled");

        // payment
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->apiContext);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','payment_faild')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return redirect()->route('pricing.plan')->with($notification);
        }

        // get paymentlink
        $approvalUrl = $payment->getApprovalLink();

        return redirect($approvalUrl);
    }

    public function paymentSuccess(Request $request){

        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','payment_faild')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            $package_id=Session::get('listing_package_id');
            return redirect()->route('user.payment.page',$package_id)->with($notification);
        }

        $payment_id=$request->get('paymentId');
        $payment = Payment::get($payment_id, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() == 'approved') {

            $package_id=Session::get('listing_package_id');
            $package=Package::find($package_id);

            if(!$package){
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
                $notification=array('messege'=>$notification,'alert-type'=>'error');

                return redirect()->route('pricing.plan')->with($notification);
            }

            $user=Auth::guard('web')->user();
            $currency=Setting::first();


            $activeOrder=Order::where(['user_id'=>$user->id,'status'=>1])->count();
            $oldOrders=Order::where('user_id',$user->id)->update(['status'=>0]);

            $setting=Setting::first();
            $amount_usd=round($package->price / $setting->currency_rate,2);

            $order=new Order();
            $order->user_id=$user->id;
            $order->order_id='#'.rand(22,44).date('Ydmis');
            $order->package_id=$package->id;
            $order->purchase_date=date('Y-m-d');
            $order->expired_day=$package->number_of_days;
            $order->expired_date=$package->number_of_days ==-1 ? null : date('Y-m-d', strtotime($package->number_of_days.' days'));
            $order->payment_method="Paypal";
            $order->transaction_id=$payment_id;
            $order->payment_status=1;
            $order->amount_usd=$amount_usd;
            $order->amount_real_currency=$package->price;
            $order->currency_type=$setting->currency_name;
            $order->currency_icon=$setting->currency_icon;
            $order->status=1;
            $order->save();




            // active and  in-active minimum limit listing
            $userListings=Property::where('user_id',$user->id)->orderBy('id','desc')->get();
            if($userListings->count() !=0){
                if($package->number_of_property !=-1){
                    foreach($userListings as $index => $listing){
                        if(++$index <= $package->number_of_property){
                            $listing->status=1;
                            $listing->save();
                        }else{
                            $listing->status=0;
                            $listing->save();
                        }
                    }
                }elseif($package->number_of_property ==-1){
                    foreach($userListings as $index => $listing){
                        $listing->status=1;
                        $listing->save();
                    }
                }
            }
            // end inactive


            // setup expired date
            if($userListings->count() != 0){
                foreach($userListings as $index => $listing){
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
            $message=str_replace('{{payment_method}}','Paypal',$message);
            $total_amount=$currency->currency_icon. $package->price;
            $message=str_replace('{{amount}}',$total_amount,$message);
            $message=str_replace('{{order_details}}',$order_details,$message);
            Mail::to($user->email)->send(new OrderConfirmation($message,$subject));


            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','order_success')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('user.my-order')->with($notification);
        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','payment_faild')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'error');

        return redirect()->route('pricing.plan')->with($notification);
    }
    public function paymentCancled(){
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','payment_faild')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'error');

        return redirect()->route('pricing.plan')->with($notification);
    }
}
