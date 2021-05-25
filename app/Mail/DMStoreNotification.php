<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DMStoreNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $user_client, $date_order;

    public function __construct(User $user, User $user_client, $date_order)
    {
        $this->user = $user;
        $this->user_client = $user_client;
        $this->date_order = $date_order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.dm_store_notification')->subject(__('You have a new Direct Message'));
    }
}
