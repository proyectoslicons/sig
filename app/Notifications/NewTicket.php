<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Pusher;
use URL;
use App\Ticket_Notification;

class NewTicket extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $ticket;
    public $id_destination;  

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id_destino, $usuario_origen, $ticket)
    {
        $this->user = $usuario_origen;
        $this->ticket = $ticket;
        $this->id_destination = $id_destino;
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

        $data['nombre']  = ucwords($this->user->primer_nombre." ". $this->user->primer_apellido);

        $data['mensaje'] = "Ha enviado un nuevo ticket";        

        $data['foto']    = URL::asset('images/'.$this->user->cedula . $this->user->primer_nombre.' '. $this->user->primer_apellido.'.jpg');

        $data['fecha']   = date('d/m/Y');

        $notificacion = new Ticket_Notification([
            'ticket_id' => $this->ticket,
            'user_id'   => $this->id_destination,
            'foto'      => $data['foto'],
            'mensaje'   => $data['mensaje'],
            'nombre'    => $data['nombre'],
        ]);

        $notificacion->save();

        $pusher->trigger('app-ticket-'.$this->id_destination, 'ticket_created', $data);

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
                    ->line($this->user->primer_nombre . ' te ha enviado un nuevo ticket.')
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
