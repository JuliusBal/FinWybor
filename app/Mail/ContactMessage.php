<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $replyEmail = $this->data['email'] ?? null;
        $replyName  = $this->data['name']  ?? null;

        return $this->subject('New contact message – FinWybor')
            ->when($replyEmail, fn ($m) => $m->replyTo($replyEmail, $replyName))
            ->view('emails.contact_message', ['data' => $this->data])
            ->text('emails.contact_message_text', ['data' => $this->data]);
    }
}
