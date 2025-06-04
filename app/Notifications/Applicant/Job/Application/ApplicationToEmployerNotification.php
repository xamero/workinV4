<?php

namespace App\Notifications\Applicant\Job\Application;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationToEmployerNotification extends Notification
{
    use Queueable;

    public $firstName, $companyName, $jobVacancyName;
    /**
     * Create a new notification instance.
     */
    public function __construct($firstName, $companyName, $jobVacancyName)
    {
        $this->firstName = $firstName;
        $this->companyName = $companyName;
        $this->jobVacancyName = $jobVacancyName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = route('welcome');
        return (new MailMessage)
            ->subject('Job Applicant Alert')
            ->greeting('Naimbag nga aldaw ' . $this->companyName . '!')
            ->line('We are pleased to inform you that an applicant is interested to one of your job listing.')
            ->line('Job Title: ' . $this->jobVacancyName)
            ->line('Click the link below to view the applicants profile.')
            ->action('Applicants Profile', $url)
            ->line('Thank you for being our partner in providing MATTaginayon a Panggedan to our Kailians!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
