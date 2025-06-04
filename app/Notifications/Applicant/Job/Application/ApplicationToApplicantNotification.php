<?php

namespace App\Notifications\Applicant\Job\Application;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationToApplicantNotification extends Notification
{
    use Queueable;

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
            ->subject('Job Application Alert')
            ->greeting('Naimbag nga aldaw ' . $this->firstName . '!')
            ->line('We are pleased to inform you that your job application with details listed below has been forwarded to ' . $this->companyName . '. This allows their Human Resource Management Office to review your profile.')
            ->line('Job title: ' . $this->jobVacancyName)
            ->action('Job Vacancy Details', url($url))
            ->line('Please update your profile regularly.')
            ->line('We wish you the best of luck in your search for MATTaginayon a Panggedan!')
            ->line('This is a system generated message.');
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
