<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $transactionCount;

    /**
     * Create a new message instance.
     *
     * @param int $transactionCount
     * @return void
     */
    public function __construct($transactionCount)
    {
        $this->transactionCount = $transactionCount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.transaction-notification')
            ->subject('Notification - Transaction Count');
    }
}
