<?php

namespace App\Notifications;

use App\Mail\MailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;

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
     * Send the email notification.
     *
     * @param  mixed  $notifiable
     * @return void
     */
    public function toMail($notifiable)
    {
        $message = $this->isEntry
            ? 'Xe của bạn đã vào cổng lúc ' . now()->format('H:i d/m/Y') . '.'
            : 'Xe của bạn đã ra cổng lúc ' . now()->format('H:i d/m/Y') . 
            ' Tiền gửi xe là ' . number_format($this->amount, 2) . ' VND.';

        // Sử dụng html() để tạo email HTML
        return (new MailMessage)
            ->subject('Thông báo gửi xe')
            ->greeting('Xin chào ' . $this->user->name)
            ->line($message)
            ->line('Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!')
            ->line('Regards, Laravel');
    }


}
