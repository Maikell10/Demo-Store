<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuestionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->markdown('emails.question_notification')->subject('Te realizaron una pregunta de TuMiniMercado');
    }
}
