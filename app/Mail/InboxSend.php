<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class InboxSend extends Mailable
{
    use Queueable, SerializesModels;

    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Buzón de quejas y sugerencias.')->markdown('emails.quejas')
            ->with([
                'userName' => $this->user->name,
                'userEmail' => $this->user->email,
                'message' => $this->message
            ]);
    }
}
