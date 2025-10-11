<?php

namespace App\Mail;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterUnsubscribed extends Mailable
{
    use Queueable, SerializesModels;

    public Subscriber $subscriber;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function build()
    {
        return $this->subject('Zrezygnowano z newslettera – FinWybor')
            ->view('emails.newsletter_unsubscribed', ['sub' => $this->subscriber])
            ->text('emails.newsletter_unsubscribed_text', ['sub' => $this->subscriber]);
    }
}
