<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Post;
class postFollowNotification extends Notification
{
    use Queueable;
    protected $post;
    protected $cat;
    protected $title;
    protected $type;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post,$title,$type)
    {
        //
        $this->post=$post;
        $this->title=$title;
        $this->type=$type;
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
        // type[1=>'userFollow',2=>'catFollow']
        return[
            'post_id'=> $this->post->id,
            'title'=> $this->title,
            'type'=>$this->type,
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
