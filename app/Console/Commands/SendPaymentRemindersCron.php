<?php

namespace App\Console\Commands;

use App\Models\UserAttempts;
use App\Mail\PaymentReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendPaymentRemindersCron extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send daily payment reminders to users who have not paid';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = UserAttempts::where('is_paid', false)->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new PaymentReminder($user));
        }

        $this->info('Payment reminders sent successfully!');
    }
}

