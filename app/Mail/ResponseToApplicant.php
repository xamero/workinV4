<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class
ResponseToApplicant extends Mailable
{
    use Queueable, SerializesModels;

    protected $details, $company, $company_email, $company_contactno, $company_hr;

    /**
     * Create a new message instance.
     */
    public function __construct($details, $company, $company_email,  $subject)
    {

        $this->details = $details;
        $this->company = $company;
        $this->company_email = $company_email;
        $this->subject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
//            from: new Address( $this->company_email, $this->company),
            replyTo: [new Address($this->company_email, $this->company->name ),],
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.employer.response-to-applicant',
            with: [
                'details' => $this->details,
                'company' => $this->company,
                'company_email' => $this->company_email,
                'company_hr' => $this->company_hr,
                'company_contactno' => $this->company_contactno
            ]
        );
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
