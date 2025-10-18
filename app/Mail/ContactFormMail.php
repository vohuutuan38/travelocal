<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
   use Queueable, SerializesModels;

    public $data; // Dữ liệu từ form sẽ được lưu ở đây

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thư liên hệ mới từ Website',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // View này sẽ được tạo ở bước tiếp theo
        return new Content(
            view: 'emails.contact-form',
        );
    }
}
