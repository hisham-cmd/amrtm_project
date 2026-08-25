<?php

namespace App\Mail;

use App\Models\Jobs\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CadresApplicationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Application $application) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'تم استلام طلبك بنجاح — منصة أمر تم',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.cadres-application-received',
        );
    }
}
