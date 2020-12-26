<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\Promotion as Promo;


class Promotion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email,$title,$content;
    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sendmail = new Promo($this->email,$this->title,$this->content);
        Mail::bcc($this->email)->queue($sendmail); 
    }
}
