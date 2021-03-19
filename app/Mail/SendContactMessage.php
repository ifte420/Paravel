<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $contact_message = "";
    public function __construct($message_data_from_contact)
    {
        $this->message_data = $message_data_from_contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $final_message_contact = $this->message_data;
        return $this->view('mail.sendcontactmessage', compact('final_message_contact'));
    }
}
