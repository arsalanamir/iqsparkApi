<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $iqPrecentage;

    public function __construct($user, $iqPrecentage)
    {
        $this->user = $user;
        $this->iqPrecentage = $iqPrecentage;
    }

    public function build()
    {
        return $this->view('emails.payment_success')
            ->subject('Payment Successful')
            ->with([
                'name' => $this->user->name,
                'email' => $this->user->email, // converting cents to dollars
                'iqPrecentage' => $this->iqPrecentage,
            ]);
    }
}
