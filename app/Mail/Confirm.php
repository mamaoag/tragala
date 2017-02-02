<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Confirm extends Mailable
{
    use Queueable, SerializesModels;
    
    public $code;
    public $firstname;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code,$firstname)
    {
        $this->code = $code;
        $this->firstname = $firstname; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@tragala.com','Tragala Support')->view('mail.confirm',['code' => $this->code, 'firstname' => $this->firstname]);
    }
}
