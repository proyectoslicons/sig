<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Pusher;
use URL;
use App\Ticket;
use App\CommentNotification;

class TicketCommented extends Notification implements ShouldQueue
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

        $data['mensaje'] = "Ha hecho un nuevo comentario sobre el ticket " . $this->ticket;        

        $data['foto']    = URL::asset('images/'.$this->user->imagen);

        $data['fecha']   = date('d/m/Y');

        $data['ticket_id'] = "" . url('solicitudes/ticket') . "/" . $this->ticket;

        $notificacion = new CommentNotification([
            'ticket_id' => $this->ticket,
            'user_id'   => $this->id_destination,
            'foto'      => $data['foto'],
            'mensaje'   => $data['mensaje'],
            'nombre'    => $data['nombre'],
        ]);

        $notificacion->save();

        $pusher->trigger('app-comments-'.$this->id_destination, 'ticket_commented', $data);
            
        $ticket = Ticket::where('ticket_id', $this->ticket)->First();

        if($ticket->user_default_id != $this->id_destination){
            $data['nombre']  = ucwords($this->user->primer_nombre." ". $this->user->primer_apellido);

            $data['mensaje'] = "Ha hecho un nuevo comentario sobre el ticket " . $this->ticket;        

            $data['foto']    = URL::asset('images/'.$this->user->imagen);

            $data['fecha']   = date('d/m/Y');

            $data['ticket_id'] = "" . url('solicitudes/ticket') . "/" . $this->ticket;

            $notificacion = new CommentNotification([
                'ticket_id' => $this->ticket,
                'user_id'   => $ticket->user_default_id,
                'foto'      => $data['foto'],
                'mensaje'   => $data['mensaje'],
                'nombre'    => $data['nombre'],
            ]);

            $notificacion->save();

            $pusher->trigger('app-comments-'.$ticket->user_default_id, 'ticket_commented', $data);   
        }

        return [];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            //
        ];
    }
}
