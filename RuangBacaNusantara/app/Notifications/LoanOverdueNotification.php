<?php
// app/Notifications/LoanOverdueNotification.php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class LoanOverdueNotification extends Notification
{
    private $loan;

    public function __construct($loan)
    {
        $this->loan = $loan;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    // Format pesan notifikasi
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your loan for the book "' . $this->loan->book->title . '" is overdue. Fine: ' . $this->loan->fine,
            'loan_id' => $this->loan->id,
            'fine' => $this->loan->fine,
        ];
    }
}
