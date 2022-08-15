<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Appointment;
use App\Mail\AppointmentPreNotification;
use Mail;
Use App\EmailTemplate;
Use App\Setting;
use Carbon\Carbon;
use App\Helpers\MailHelper;
class PreNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prenotification:appointment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Appointment Pre-Notification';

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
       $appointments=Appointment::where('already_treated',0)->get();
        $setting=Setting::first();

        foreach($appointments as $appointment){
            $template=EmailTemplate::where('id',7)->first();
            $message=$template->description;
            $subject=$template->subject;

            $schedule=$appointment->schedule->start_time.'-'.$appointment->schedule->end_time;
            $message=str_replace('{{patient_name}}',$appointment->user->name,$message);
            $message=str_replace('{{schedule}}',$schedule,$message);
            $message=str_replace('{{date}}',$appointment->date,$message);
            $message=str_replace('{{doctor_name}}',$appointment->doctor->name,$message);


            $appointment_time=strtotime($appointment->date.$appointment->schedule->start_time);

            $pre_notify_time=$appointment_time- $setting->prenotification_hour * 3600;

            $current_time=Carbon::now()->timestamp;

            MailHelper::setMailConfig();

            if($pre_notify_time==$current_time){
                Mail::to($appointment->user->email)->send(new AppointmentPreNotification($subject,$message));
            }
        }
        echo "done";
    }
}
