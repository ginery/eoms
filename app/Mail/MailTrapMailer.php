<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailTrapMailer extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function build()
    {
        return $this->subject('Verify you account.')
                    ->from('chmsualijisextensionoffice@gmail.com')
                    ->view('email.index')
                    ->with('name', $this->name);
    }


    public function envelope()
    {
        return new Envelope(
            subject: 'Hello',
        );
    }

    public function attachments()
    {
        return [];
    }
}

