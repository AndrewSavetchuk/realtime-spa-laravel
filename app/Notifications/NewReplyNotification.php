<?php

namespace App\Notifications;

use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewReplyNotification extends Notification implements ShouldQueue
{
  use Queueable;

  public $reply;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct(Reply $reply)
  {
    $this->reply = $reply;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param  mixed $notifiable
   *
   * @return array
   */
  public function via($notifiable)
  {
    return ['database', 'broadcast'];
  }

  /**
   * Get the array representation of the notification.
   *
   * @param  mixed $notifiable
   *
   * @return array
   */
  public function toDatabase($notifiable)
  {
    return [
      'repliedBy' => $this->reply->user->name,
      'question'  => $this->reply->question->title,
      'path'      => $this->reply->questionPath,
    ];
  }

  /**
   * Get the broadcastable representation of the notification.
   *
   * @param  mixed $notifiable
   *
   * @return BroadcastMessage
   */
  public function toBroadcast($notifiable)
  {
    return new BroadcastMessage([
      'repliedBy' => $this->reply->user->name,
      'question'  => $this->reply->question->title,
      'path'      => $this->reply->questionPath,
      'reply'     => new ReplyResource($this->reply),
    ]);
  }
}
