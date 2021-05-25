<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestCategoryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $admin, $user_client, $body;

    public function __construct(User $admin, User $user_client, $body)
    {
        $this->admin = $admin;
        $this->user_client = $user_client;
        $this->body = $body;
    }

    public function build()
    {
        return $this->markdown('emails.req_category_notification')->subject('Pedido de Categoría Nueva');
    }
}
