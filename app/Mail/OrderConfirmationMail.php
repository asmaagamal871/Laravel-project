<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable;
    use SerializesModels;
    public $order;
    public $notifiable;
    /**
     * Create a new message instance.
     */
    public function __construct($order, $notifiable)
    {
        $this->order = $order;
        $this->notifiable = $notifiable;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->markdown('email.orderConfirmation')
        ->with([
            'order' => $this->order,
            'notifiable' => $this->notifiable,
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
