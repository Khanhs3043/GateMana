<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailTemplate extends Mailable
{
    use SerializesModels;

    protected $user;
    protected $isEntry;
    protected $amount;

    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
{
    $message = $this->isEntry
        ? 'Xe của bạn đã vào cổng lúc ' . now()->format('H:i d/m/Y') . '.'
        : 'Xe của bạn đã ra cổng lúc ' . now()->format('H:i d/m/Y') . 
          ' Tiền gửi xe là ' . number_format($this->amount, 2) . ' VND.';

    return $this->subject('Thông báo gửi xe')
                ->view('emails.notification', [
                    'user' => $this->user,
                    'message' => $message,
                ]);
}

}
