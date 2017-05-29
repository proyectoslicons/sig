<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Pusher;

class NewTicket extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $ticket;  

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $ticket)
    {
        $this->user = $user;
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {                  

        $pusher = new Pusher(
            'dd41cdbc530d473d6e24',
            '397f3697eff2efdc15b5',
            '342744'
        );

        $data['message'] = 'Notificando';
        $pusher->trigger('app-ticket-'.$this->user->id, 'ticket_created', $data);

        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->user->name . ' te ha enviado un nuevo ticket.')
                    ->action('Ver Ticket', url('solicitudes/listarTickets'))
                    ->line('Has clic en el enlace para ver el ticket creado.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'name' => $this->user->name,
            'message' => $this->user->name . ' te ha enviado un nuevo ticket.'
        ];
    }

}
