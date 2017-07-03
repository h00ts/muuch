<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserActivated extends Mailable
{
    use Queueable, SerializesModels;

    protected $activation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Activation $activation)
    {
        $this->activation = $activation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.activated')
                    ->with([
                        'url' => 'http://muuch.ilumexico.mx/activar/'.$this->activation->token,
                        'userName' => $this->activation->user->name,
                    ]);
    }
}
