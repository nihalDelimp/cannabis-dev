<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendQR_CodeNotification extends Mailable
{
    use Queueable, SerializesModels;
    // public $from;
    // public $subject;
    // public $data;
    //public $sendUrl;
    public $body;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body)
    {
        // $this->from = $from;
        // $this->subject = $subject;
        // $this->data = $data;
        $this->body = $body;
        //$this->sendUrl = $sendUrl;
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from(env('MAIL_FROM_ADDRESS'))
        // ->markdown('includes.email.loginWithNewPassword')->with('body',$this->body);
        
        return $this->from('nihal@delimp.com')
                ->markdown('includes.email.qr_codeNotification')->with([
                    'body'=>$this->body,
                    'type' => 'png'
                ]);
    }
}
