<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use File;

class ForgotMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data){
      $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
      $template = getEmailTemplate('forgot-password-success');
      File::put(base_path('resources/views/includes/email/forgot_password.blade.php'),$template['message']);
      return $this->from('info@thsbooking.com','Cannabis Capitol')->subject(langMessage($template['subject']))->view('includes.email.forgot_password')->with('data', $this->data);
    }
}
