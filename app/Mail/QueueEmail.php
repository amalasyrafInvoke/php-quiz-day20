<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QueueEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $email_list;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->email_list = env(ADMIN_EMAIL, 'amaluddinasyraf@invokeisdata.com');

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.testQueueMail',
        [
            'email_list' =>$this->email_list
        ]
    );
    }
}
