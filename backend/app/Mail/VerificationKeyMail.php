<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationKeyMail extends Mailable
{
    use Queueable, SerializesModels;

    public int $code;

    /**
     * Create a new message instance.
     */
    public function __construct(int $code)
    {
        $this->code = $code;
    }

    public function build()
    {
        return $this->subject('B League - Verification code')
            ->view('emails.verification-key')
            ->with([
                'code' => $this->code
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
