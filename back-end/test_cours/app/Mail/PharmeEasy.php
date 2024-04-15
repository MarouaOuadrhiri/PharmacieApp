<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PharmeEasy extends Mailable
{
    use Queueable, SerializesModels;
    protected $randomNumber;
    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
        $this->randomNumber = mt_rand(100000, 999999); 
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pharme Easy',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'EmailContent',
    //         data: ['randomNumber' => $this->randomNumber],
    //         //'Your code activation: ' . $this->randomNumber,
    //     );
    // }

    public function content(): Content
{
    return (new Content())->view('EmailContent')->with(['randomNumber' => $this->randomNumber]);
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
