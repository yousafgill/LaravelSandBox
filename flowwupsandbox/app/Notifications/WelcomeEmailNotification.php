<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmailNotification extends Notification
{
    use Queueable;

    private $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($detail)
    {
        //
        $this->data=$detail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if($this->data['logintype']=='public'){
            return (new MailMessage)
            ->greeting("Hello " . $this->data['name'])
            ->line('Welcome to Flowwup, thank you for joining us.')
            ->line('This is the URL of your Flowwup domain:')
            ->action('Go to your portal', $this->data['domain'])
            ->line('Check the Roadmap : '. $this->data['roadmapurl'])
            ->line('If you have any questions, please respond to this email and we’ll be happy to help :-)')
            ->line('');
        }else{
            return (new MailMessage)
            ->greeting("Hello " . $this->data['name'])
            ->line('Welcome to Flowwup, thank you for joining us.')
            ->line('This is the URL of your Flowwup domain:')
            ->action('Go to your portal', $this->data['domain'])
            ->line('First Steps')
            ->line('1 : create your first feedback board. '. $this->data['boardsurl'])
            ->line('2 : Share your Public Roadmap URL to your users : '. $this->data['roadmapurl'])
            ->line('3 : Invite Team Members  : '.$this->data['inviteurl'])
            ->line('')
            ->line('If you have any questions, please respond to this email and we’ll be happy to help :-)')
            ->line('');
        }
       
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
