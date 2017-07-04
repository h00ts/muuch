<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Activation;
use App\User;

class UserActivated extends Mailable
{
    use Queueable, SerializesModels;

    protected $activation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Activation $activation, User $user)
    {
        $this->activation = $activation;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Activa tu cuenta de MUUCH.')->markdown('emails.activation')
                    ->with([
                        'url' => 'http://muuch.ilumexico.mx/activar/'.$this->activation->token,
                        'userName' => $this->user->name,
                        'userEmail' => $this->user->email
                    ]);
    }
}
