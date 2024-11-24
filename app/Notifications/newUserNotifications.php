<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class newUserNotifications extends Notification
{
    use Queueable;
   protected $user;
   protected $comment;
   protected $cat;
   protected $title;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user,$title)
    {
        //
        $this->user=$user;
        $this->title=$title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDataBase($notifiable)
    {
        return[
            'user_id'=> $this->user->id,
            'username'=>$this->user->name,
            'title'=> $this->title,
        ];
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
