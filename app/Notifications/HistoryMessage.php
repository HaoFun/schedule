<?php

namespace App\Notifications;

use App\Handlers\TransformerHistoryHandler;
use App\Models\History;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class HistoryMessage extends Notification
{
    use Queueable, TransformerHistoryHandler;

    protected $history;

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {

    }

    public function toBroadcast($notifiable)
    {

    }
}
