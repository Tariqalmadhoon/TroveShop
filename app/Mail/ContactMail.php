<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * إنشاء رسالة جديدة.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * بناء الرسالة.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Contact Message')
                    ->view('front.contactmail');
    }
}
