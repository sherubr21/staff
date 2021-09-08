<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRejectLeaveMail extends Mailable
{
	//public $name;
    use Queueable, SerializesModels;
	public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
      // $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->from('example@example.com')->subject('Leave not approved yet')->view('view.RejectLeaveView');
    }
}
