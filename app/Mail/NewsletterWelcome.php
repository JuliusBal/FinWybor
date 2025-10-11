<?php

namespace App\Mail;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterWelcome extends Mailable
{
    use Queueable, SerializesModels;

    public Subscriber $subscriber;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function build()
    {
        return $this->subject('Dziękujemy za zapis — FinWybor')
            ->view('emails.newsletter_welcome', ['sub' => $this->subscriber])
            ->text('emails.newsletter_welcome_text', ['sub' => $this->subscriber]);
    }
}
