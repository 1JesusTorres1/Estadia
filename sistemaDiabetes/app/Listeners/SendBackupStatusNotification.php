<?php

namespace App\Listeners;

use Spatie\Backup\Events\BackupWasSuccessful;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BackupStatusNotification;

class SendBackupStatusNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BackupWasSuccessful $event): void
    {
        // Obtener el usuario autenticado que inició el respaldo
        $user = Auth::user();

        // Si hay un usuario, enviarle la notificación
        if ($user) {
            $user->notify(new BackupStatusNotification($event));
        }
    }
}
