<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Spatie\Backup\Events\BackupWasSuccessful;

class BackupStatusNotification extends Notification
{
    use Queueable;

    protected $event;

    /**
     * Create a new notification instance.
     */
    public function __construct(BackupWasSuccessful $event)
    {
        $this->event = $event;
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
        $appName = $this->event->backupDestination->backupName();
        $diskName = $this->event->backupDestination->diskName();

        return (new MailMessage)
                    ->success()
                    ->subject("Respaldo de {$appName} completado exitosamente")
                    ->line("¡Hola, {$notifiable->name}!")
                    ->line("Se ha creado un nuevo respaldo para la aplicación '{$appName}'.")
                    ->line("El respaldo se ha guardado en el disco '{$diskName}'.")
                    ->action('Ver Respaldos', route('admin.backup.index'))
                    ->line('¡Gracias por mantener la aplicación segura!');
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
