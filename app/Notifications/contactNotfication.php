<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Contact;
class contactNotfication extends Notification
{
    use Queueable;
   protected $contact;
   protected $title;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Contact $contact,$title)
    {
        //
        $this->contact=$contact;
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
            'contact_id'=> $this->contact->id,
            'msg'=>$this->contact->desc,
            'user'=>$this->contact->email,
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
