<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketAccepted extends Notification
{
    use Queueable;

    protected $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Bisa melalui email dan juga disimpan ke database
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Your ticket has been accepted and scheduled by a guru.')
                    ->action('View Ticket', url('/tickets/' . $this->ticket->id))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'ticket_id' => $this->ticket->id,
            'message' => 'Your ticket has been accepted and scheduled by a guru.',
        ];
    }
}
