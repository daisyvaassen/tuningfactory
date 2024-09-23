<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Laravel\Cashier\SubscriptionBuilder\RedirectToCheckoutResponse;

class Subscription extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';

    protected static string $view = 'filament.pages.subscription';

    protected static bool $shouldRegisterNavigation = true;

    protected static ?string $navigationGroup = 'Administration';

    protected static ?int $navigationSort = 2;

    public bool $failed = false;

    public bool $success = false;

    public bool $cancel = false;

    protected static string $subscriptionName = 'Tuning Factory Membership';

    public function mount(): void
    {
        if (request()->has('success')) {
            $this->success = true;
        }

        if (request()->has('cancel')) {
            $this->cancel = true;
        }

        if (request()->has('error')) {
            $this->failed = true;
        }
    }

    public function subscribe(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        session()->flash('success', 'Subscription has been cancelled.');

//        if (!$user->subscribed(static::$subscriptionName, 'monthly')) {
//            $result = $user
//                ->newSubscription(static::$subscriptionName, 'monthly')
//                ->create();
//
//            if (is_a($result, RedirectToCheckoutResponse::class)) {
//                redirect($result->getTargetUrl());
//            }
//
//            if (is_a($result, \Laravel\Cashier\Subscription::class)) {
//                $this->success = true;
//            }
//        } else {
//            $this->success = true;
//        }
    }

    public function cancel(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if ($user->subscribed(static::$subscriptionName, 'monthly')) {

        }

        session()->flash('success', 'Subscription has been cancelled.');
    }
}
