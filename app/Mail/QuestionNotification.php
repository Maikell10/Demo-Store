<?php

namespace App\Mail;

use App\Product;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuestionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $user_client, $product;
    
    public function __construct(User $user, User $user_client, Product $product)
    {
        $this->user = $user;
        $this->user_client = $user_client;
        $this->product = $product;
    }

    public function build()
    {
        return $this->markdown('emails.question_notification')->subject('Te realizaron una pregunta de TuMiniMercado');
    }
}
