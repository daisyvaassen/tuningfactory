<?php

namespace App\Listeners;

use App\Contracts\TelegramServiceInterface;
use App\Services\TelegramService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;
use Laravel\Cashier\Events\FirstPaymentPaid;

class SendFirstPaymentPaidNotification implements ShouldQueue
{
    /**
     * @var TelegramService $telegramService
     */
    protected TelegramService $telegramService;

    /**
     * Create the event listener.
     */
    public function __construct(TelegramServiceInterface $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    /**
     * Handle the event.
     */
    public function handle(FirstPaymentPaid $event): void
    {
        $this->telegramService->sendMessage('First payment paid!');
    }
}
