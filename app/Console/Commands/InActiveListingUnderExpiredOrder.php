<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;
use App\Listing;
class InActiveListingUnderExpiredOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inactive:listing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inactive all listing under Expired Order';

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
        $orders=Order::where('status',1)->get();
        $orders=$orders->where('expired_date','!=',null);
        foreach($orders as $index => $order){
            $today=date('Y-m-d');
            if($today==$order->expired_date){
                Listing::where('user_id',$order->user_id)->update(['status'=>0]);
            }
        }
        echo "inactive listing";
        return 0;
    }
}
