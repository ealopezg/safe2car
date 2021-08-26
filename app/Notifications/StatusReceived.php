<?php

namespace App\Notifications;
use App\Models\Status;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;

class StatusReceived extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
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

    public function toTelegram($notifiable)
    {
        $url = url('/vehicle/' . $this->status->vehicle->id);
        $t_message = TelegramMessage::create()
                        ->to($notifiable->telegram_user_id)
                        ->button('Ver estado', $url);
        switch ($this->status->action) {
            case 'photo':
                $photo = $this->status->statusable;
                $t_message = $t_message->file('/storage/app/'.$photo->path, 'photo')->content('Nueva fotografía');
                break;
            case 'location':
                $location = $this->status->statusable;
                $t_message = $t_message->latitude($location->latitude)->longitude($location->longitude)->content('Nueva ubicación');
                break;
            case 'motion':
                $t_message = $t_message->content('Se ha detectado movimiento en el vehículo');
                break;
            default:
                # code...
                break;
        }
        return $t_message;

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
