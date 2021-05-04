<?php

namespace App\Mail;

use App\Sale;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user, $sale;

    public function __construct(User $user, Sale $sale)
    {
        $this->user = $user;
        $this->sale = $sale;
    }

    public function build()
    {
        return $this->markdown('emails.purchase_notification')->subject(__('You Have Placed a New Order'));
    }
}
