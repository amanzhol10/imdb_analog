<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DemoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $demo;

    public function __construct($demo)
    {
        $this->demo = $demo;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Demo Email',
        );
    }

    public function content(): Content
    {
        return new Content(
            // Указываем вашу папку 'mails' и файл 'demo'
            view: 'mails.demo',            
            // Если используете текстовую версию, указываем 'mails.demo_plain'
            text: 'mails.demo_plain',      
            with: [
                'testVarOne' => '1',
                'testVarTwo' => '2',
            ],
        );
    }
}