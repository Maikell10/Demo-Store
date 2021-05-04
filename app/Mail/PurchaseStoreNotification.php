<?php

namespace App\Mail;

use App\Sale;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseStoreNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user, $sale, $user_store;

    public function __construct(User $user, Sale $sale, User $user_store)
    {
        $this->user = $user;
        $this->sale = $sale;
        $this->user_store = $user_store;
    }

    public function build()
    {
        return $this->markdown('emails.purchase_store_notification')->subject(__('You Have a New Order'));
    }
}
