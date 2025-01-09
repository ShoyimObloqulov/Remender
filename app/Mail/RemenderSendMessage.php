<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RemenderSendMessage extends Mailable
{
    use Queueable, SerializesModels;
    public $message;
    public $organization;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('email.message')->subject('Для вас есть напоминание')
            ->with([
                'remender' => $this->data
            ]);
    }
}
