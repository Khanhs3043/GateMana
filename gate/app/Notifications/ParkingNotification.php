<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ParkingNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $isEntry;
    protected $amount;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $isEntry, $amount = null)
    {
        $this->user = $user;
        $this->isEntry = $isEntry;
        $this->amount = $amount;
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
        if ($this->isEntry) {
            return (new MailMessage)
                ->greeting('Xin chào ' . $this->user->name)
                ->line('Xe của bạn đã vào cổng lúc ' . now()->format('H:i d/m/Y') . '.')
                ->line('Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!');
        } else {
            return (new MailMessage)
                ->greeting('Xin chào ' . $this->user->name)
                ->line('Xe của bạn đã ra cổng lúc ' . now()->format('H:i d/m/Y') . '.')
                ->line('Tiền gửi xe là ' . number_format($this->amount, 2) . ' VND.')
                ->line('Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!');
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
            'isEntry' => $this->isEntry,
            'amount' => $this->amount,
        ];
    }
}
