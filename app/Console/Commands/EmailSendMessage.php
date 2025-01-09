<?php

namespace App\Console\Commands;

use App\Http\Controllers\RemenderController;
use App\Models\RemenderHasEmail;
use App\Models\RemenderHasPhone;
use Illuminate\Console\Command;
use App\Models\Remender;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RemenderSendMessage;

class EmailSendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remender:sendMessage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $remenders = Remender::reminders();

        foreach($remenders as $remender){
            $this->SendMessage($remender->id);
        }
    }

    private function SendMessage($id)
    {
        $remender = Remender::find($id);

        $email = User::find($remender->users_id)->email;
        $subject = new RemenderSendMessage();
        $subject->message = $remender->name;
        $subject->organization = $remender->desc;
        $subject->data = $remender;

        $email = RemenderHasEmail::where('remender_id',$id)->get();
        foreach ($email as $e) {
            Mail::to($e->email)->send($subject);
        }

        $phone = RemenderHasPhone::where('remender_id',$id)->get();

        foreach ($phone as $p) {
            sendSMS($p,$remender);
        }
    }
}
