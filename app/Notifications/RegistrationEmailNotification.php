<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
class RegistrationEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $userdata)
    {
        $this->user = $userdata;
        
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
        
        return (new MailMessage)
        
                    ->line('Welcome '.$this->user->name.' to our eccomerce application.')
                    ->line('Please click the following link to activate your account')
                    ->action('Click here',url("http://localhost/ecommerce/public/activate/{$this->user->email_verification_token}"))
                    ->line('Thank you for using our application!');
    }

}
