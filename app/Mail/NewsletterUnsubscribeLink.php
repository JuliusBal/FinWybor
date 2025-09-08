<?php

namespace App\Mail;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterUnsubscribeLink extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Subscriber $subscriber) {}

    public function build()
    {
        return $this->subject('Wypisz się z newslettera')
            ->markdown('emails.unsubscribe-link', [
                'url' => route('newsletter.unsubscribe', $this->subscriber->token),
            ]);
    }
}
