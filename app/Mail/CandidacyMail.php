<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CandidacyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $desiredRole;
    public $educationLevel;
    public $observations;
    public $ip;
    public $cvFile;

    public function __construct(string $name, string $desiredRole, string $educationLevel, string $observations, string $ip, string $cvFile)
    {
        $this->name = $name;
        $this->desiredRole = $desiredRole;
        $this->educationLevel = $educationLevel;
        $this->observations = $observations;
        $this->ip = $ip;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Candidacy Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.candidacy',
            with: [
                'name' => $this->name,
                'desiredRole' => $this->desiredRole,
                'educationLevel' => $this->educationLevel,
                'observations' => $this->observations,
                'ip' => $this->ip,
                'cvFile' => $this->cvFile
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
