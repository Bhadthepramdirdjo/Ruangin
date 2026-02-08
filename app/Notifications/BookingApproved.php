<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingApproved extends Notification
{
    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $bookingUrl = 'https://ruanginapp.infinityfree.me/booking/' . $this->booking->id;
        
        return (new MailMessage)
            ->subject('✅ Booking Ruangan Disetujui - Ruangin')
            ->view('emails.booking-approved', [
                'userName' => $notifiable->nama,
                'ruangan' => $this->booking->ruangan,
                'booking' => $this->booking,
                'bookingUrl' => $bookingUrl,
            ]);
    }
}
