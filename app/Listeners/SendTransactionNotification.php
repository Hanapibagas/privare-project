<?php

namespace App\Listeners;

use App\Events\TransactionCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionNotification;

class SendTransactionNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  TransactionCompleted  $event
     * @return void
     */
    public function handle(TransactionCompleted $event)
    {
        // Mengirim email notifikasi ke pengguna
        Mail::to($event->userId)->send(new TransactionNotification($event->transactionCount));
    }
}
