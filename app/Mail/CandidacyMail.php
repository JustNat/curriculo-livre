<?php

namespace App\Mail;

use App\Enums\EducationLevel;
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

    public function __construct(string $name, string $desiredRole, string $educationLevel, string|null $observations, string $ip)
    {
        $this->name = $name;
        $this->desiredRole = $desiredRole;
        if ($educationLevel == 'MEDIUM_SCHOOL') {
            $this->educationLevel = 'Ensino fundamental';
        } else if ($educationLevel == 'HIGH_SCHOOL') {
            $this->educationLevel = 'Ensino médio';
        } else if ($educationLevel == 'UNDERGRADUATE') {
            $this->educationLevel = 'Graduado(a)';
        } else if ($educationLevel = 'POSTGRADUATE') {
            $this->educationLevel = 'Pós-graduado(a)';
        } else if ($educationLevel = 'MASTER') {
            $this->educationLevel = 'Mestrado';
        } else {
            $this->educationLevel = 'Doutorado';
        }
        $this->observations = $observations;
        $this->ip = $ip;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Candidatura',
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
