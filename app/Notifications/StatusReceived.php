<?php

namespace App\Notifications;
use App\Models\Status;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramLocation;
use NotificationChannels\Telegram\Telegram;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;


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

        switch ($this->status->action) {
            case 'photo':
                $photo = $this->status->statusable;
                return TelegramFile::create()
                    ->to($notifiable->telegram_user_id)
                    ->content('📸 Fotografía de tu vehiculo '.$this->status->vehicle->license_plate)
                    ->file(Storage::path($photo->path), 'photo');
                break;
            case 'location':
                $location = $this->status->statusable;
                $message = TelegramMessage::create()
                        ->to($notifiable->telegram_user_id)
                        ->content('📍 Ubicación tu vehículo '.$this->status->vehicle->license_plate)
                        ->toArray();

                $telegram = new Telegram(config('services.telegram-bot-api.token'));
                $telegram->sendMessage($message);
                return TelegramLocation::create()
                    ->to($notifiable->telegram_user_id)
                    ->latitude($location->latitude)
                    ->longitude($location->longitude);
                break;
            case 'motion':
                return TelegramMessage::create()
                    ->to($notifiable->telegram_user_id)
                    ->content('😮 Nuevo movimiento en tu vehículo '.$this->status->vehicle->license_plate);
                break;
            default:
                # code...
                break;
        }

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
