<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\postInfraction;
class InfractionNotfication extends Notification
{
    use Queueable;
   protected $infraction;
   protected $title;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(postInfraction $infraction,$title)
    {
        //
        $this->infraction=$infraction;
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
            'infraction_id'=>$this->infraction->id,
            'user'=>$this->infraction->user->name,
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
