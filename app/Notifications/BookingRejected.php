<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingRejected extends Notification
{
    public $booking;
    public $reason;

    public function __construct(Booking $booking, $reason = null)
    {
        $this->booking = $booking;
        $this->reason = $reason;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $bookingCreateUrl = 'https://ruanginapp.infinityfree.me';
        
        return (new MailMessage)
            ->subject('❌ Booking Ruangan Ditolak - Ruangin')
            ->view('emails.booking-rejected', [
                'userName' => $notifiable->nama,
                'ruangan' => $this->booking->ruangan,
                'booking' => $this->booking,
                'reason' => $this->reason,
                'bookingCreateUrl' => $bookingCreateUrl,
            ]);
    }
}
