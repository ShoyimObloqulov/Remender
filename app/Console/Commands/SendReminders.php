<?php

namespace App\Console\Commands;

use App\Models\Remender;
use App\Notifications\ReminderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminders send';

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
     * @return void
     */
    public function handle()
    {
        $currentMonthDay = Carbon::now()->format('m/d');
        $tomorrowMonthDay = Carbon::now()->addDay()->format('m/d');

        $todayReminders = Remender::whereRaw("DATE_FORMAT(STR_TO_DATE(date, '%m/%d/%Y %H:%i'), '%m/%d') = ?", [$currentMonthDay])->get();
        $tomorrowReminders = Remender::whereRaw("DATE_FORMAT(STR_TO_DATE(date, '%m/%d/%Y %H:%i'), '%m/%d') = ?", [$tomorrowMonthDay])->get();

        foreach ($todayReminders as $reminder) {
            if (!empty($reminder->email)) {
                foreach ($reminder->email as $email) {
                    Notification::route('mail', $email->email)->notify(new ReminderNotification($reminder));
                }
            }
        }

        foreach ($tomorrowReminders as $reminder) {
            if (!empty($reminder->email)) {
                foreach ($reminder->email as $email) {
                    Notification::route('mail', $email->email)->notify(new ReminderNotification($reminder));
                }
            }
        }


    }
}
