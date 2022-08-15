<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Subscribe;
class InActiveSubscriber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inactive:subscriber';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Autmaticaly Inactive subscriber Everyday';

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
        $subscribers=Subscribe::where('status',0)->get();
        foreach($subscribers as $subscriber){
            Subscribe::destroy($subscriber->id);
        }
    }
}
