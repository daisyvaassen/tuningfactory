<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ChargeOverusage implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Charge users for overusage, see which have apiUsages and where the apiusage is greater
        $overusages = \App\Models\ApiUsage::with('user')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->selectRaw('user_id, sum(request_count) as total_requests')
            ->groupBy('user_id')
            ->having('total_requests', '>', 10000)
            ->get();

        foreach ($overusages as $overusage) {
            $chargeAmount = ($overusage->total_requests - 10000) / 1000 * 100;

            $item = new \Laravel\Cashier\Charge\ChargeItemBuilder($overusage->user);
            $item->unitPrice(money($chargeAmount, 'EUR'));
            $item->description('Overusage charge for ' . $overusage->total_requests . ' total requests');
            $chargeItem = $item->make();

            $result = $overusage->user->newCharge()
                ->addItem($chargeItem)
                ->setRedirectUrl(\App\Filament\Pages\Subscription::getUrl())
                ->create();

            if(is_a($result, \Laravel\Cashier\Http\RedirectToCheckoutResponse::class)) {
                $overusage->user->notify(new \App\Notifications\OveruseInvoiceOpenNotification());
            } else {
                $overusage->user->notify(new \App\Notifications\OveruseInvoiceCreatedNotification());
            }
        }
    }
}
