<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;
use App\Mail\ExpiredOrderPreNotify;
use Mail;
Use App\EmailTemplate;
Use App\Setting;
use Carbon\Carbon;
use App\Helpers\MailHelper;
class ExpireOrderNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expired Order Pre Notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $setting=Setting::first();
        $orders=Order::all();
        foreach($orders as $order){
            $order_details='Total Amount: '.$order->amount.'<br>';
            $order_details='Purchase Date: '.$order->purchase_date.'<br>';
            $order_details .='Expired Date: '.$order->expired_date;

            $template=EmailTemplate::where('id',7)->first();
            $message=$template->description;
            $subject=$template->subject;
            $message=str_replace('{{user_name}}',$order->user->name,$message);
            $message=str_replace('{{expire_date}}',$order->expired_date,$message);
            $message=str_replace('{{order_details}}',$order_details,$message);

            $pre_notify_time= strtotime($order->expired_date)- (24 * $setting->prenotification_day)*3600;
            $today=strtotime(date('Y-m-d'));
            MailHelper::setMailConfig();
            if($pre_notify_time==$today){
                Mail::to($order->user->email)->send(new ExpiredOrderPreNotify($subject,$message));
            }
        }
        echo "success";

    }
}
