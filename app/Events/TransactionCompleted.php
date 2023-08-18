<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransactionCompleted
{
    use Dispatchable, SerializesModels;

    public $userId;
    public $transactionCount;

    /**
     * Create a new event instance.
     *
     * @param int $userId
     * @param int $transactionCount
     * @return void
     */
    public function __construct($userId, $transactionCount)
    {
        $this->userId = $userId;
        $this->transactionCount = $transactionCount;
    }
}
