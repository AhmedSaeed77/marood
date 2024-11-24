<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Cat;
use App\Models\Post;
use App\Models\Comment;
class commentNotification extends Notification
{
    use Queueable;
   protected $post;
   protected $comment;
   protected $cat;
   protected $title;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post,Comment $comment,$title)
    {
        //
        $this->post=$post;
        $this->comment=$comment;
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
            'post_id'=> $this->post->id,
            'post_title'=>$this->post->title_ar,
            'comment_id'=> $this->comment->id,
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
