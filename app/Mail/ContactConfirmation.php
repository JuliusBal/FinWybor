<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Dziękujemy za kontakt z FinWybor')
            ->view('emails.contact_confirmation', ['data' => $this->data])
            ->text('emails.contact_confirmation_text', ['data' => $this->data]);
    }
}
