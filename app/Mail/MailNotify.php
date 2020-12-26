<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
    public $getOrder;
    public $getOrderDetail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($getOrder,$getOrderDetail)
    {
        $this->getOrder = $getOrder;
        $this->getOrderDetail = $getOrderDetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thông báo đặt hàng')
                    ->view('mail.email');
    }
}
