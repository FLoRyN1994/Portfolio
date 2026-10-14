<?php

namespace App\Notifications;

use App\Models\ContactSubmission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactNotification extends Notification implements ShouldQueue
{
    public function __construct(private readonly ContactSubmission $submission) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New contact: '.$this->submission->name)
            ->greeting('New message from your portfolio')
            ->line('**From:** '.$this->submission->name.' ('.$this->submission->email.')')
            ->line('**Message:**')
            ->line($this->submission->message)
            ->action('View in admin', url('/admin/contact-submissions/'.$this->submission->id.'/edit'));
    }
}
