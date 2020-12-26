<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Promotion extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $title,$content,$email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$title,$content)
    {
        $this->title = $title;
        $this->content = $content;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thông báo')
                    ->view('mail.promotion');
    }
}
