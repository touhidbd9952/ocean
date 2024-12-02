<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class job_seeker_reg_success_Mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        //from website to woody email 
        return $this->from('info@woodyltd.com')->view('mail.job_seeker_reg_success_Mail',compact('data'))->subject('Registration Success Mail form Free Man Service');
        //return $this->view('view.name');
    }
}
