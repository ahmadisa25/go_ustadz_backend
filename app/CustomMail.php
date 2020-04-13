<?php

namespace App;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
 
use Illuminate\Database\Eloquent\Model;

class CustomMail extends Mailable
{
       use Queueable, SerializesModels;
 
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->from('no-reply@ayongaji.com')
                   ->view('custom_mail')
                   ->with(
                    [
                        'nama' => 'no-reply',
                        'website' => 'www.royroy.com',
                    ]);
    }
}
