<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Message;
use App\User;

class NewMessage extends Notification implements ShouldQueue
{

    protected $user;
    protected $message;
    use Queueable;
    public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'message_id' => $this->message->id,
            'subject' => $this->message->subject,
        ];
    }
}
