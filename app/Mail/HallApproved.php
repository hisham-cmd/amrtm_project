<?php

namespace App\Mail;

use App\Models\Hall;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HallApproved extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Hall $hall) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'تهانينا! تم تفعيل حسابك في منصة أمر تم',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.hall-approved',
        );
    }
}
