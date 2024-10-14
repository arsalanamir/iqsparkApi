<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $percentage;
    public $pdfUrl;

    public function __construct($user, $percentage, $pdfUrl)
    {
        $this->user = $user;
        $this->percentage = $percentage;
        $this->pdfUrl = $pdfUrl;
    }

    public function build()
    {
        return $this->view('emails.payment_success')
            ->subject('Payment Successful')
            ->with([
                'name' => $this->user->name,
                'email' => $this->user->email,
                'percentage' => $this->percentage,
                'pdfUrl' => $this->pdfUrl,
            ]);
    }
}
