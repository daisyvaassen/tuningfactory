<x-filament-panels::page>
    @if($failed)
        <div class="bg-red-200 rounded-md px-4 py-2 text-red-600">
            Something went wrong. Please try again. If the problem persists, please contact us.
        </div>
    @endif

    @if($cancel)
        <div class="bg-red-200 rounded-md px-4 py-2 text-red-600">
            You cancelled the subscription. If you want to subscribe to our service, please try again.
        </div>
    @endif

    @if($success)
        <div class="bg-green-200 rounded-md px-4 py-2 text-green-600">
            You successfully subscribed to our service. You can now make use of our API. If you have any questions, please contact us.
        </div>
    @endif

    @if(session('success'))
        <a href="google.com" class="border p-4 rounded-md flex items-center gap-4 justify-between group transition-all hover:border-gray-400">
            <div class="flex items-center gap-4">
                <div>
                    <div class="w-8 h-8 p-1.5 bg-primary-600 rounded-md text-white shrink">
                        <x-heroicon-o-information-circle />
                    </div>
                </div>

                <span class="text-sm text-gray-500">You can create API beforehand, to use the API in your application, you need to pay for a subscription if you haven't already. If you've paid for a subscription, you can ignore this message</span>
            </div>

            <x-heroicon-o-chevron-right class="w-5 h-5 text-gray-500 group-hover:text-gray-600 transition-all transform group-hover:translate-x-0.5" />
        </a>
    @endif

    <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @if(!auth()->user()->subscribed('Tuning Factory Membership', 'monthly'))
                <div class="col-span-1">
                    <h2 class="text-lg font-bold mb-2">Your plan: Free</h2>
                    <p class="text-gray-500 text-sm mb-2">If you are interested in our product and you want to use the API, you can subscript to our service.</p>
                </div>
            @else
                <div class="col-span-1">
                    <h2 class="text-lg font-bold mb-2">You're on the premium plan!</h2>
                    <p class="text-gray-500 text-sm mb-2">That's great! You can now make use of our <a class="text-primary-500 underline" href="{{ \App\Filament\Pages\ApiTokens::getUrl() }}">API</a>. If you need any support, please contact us. If you want to change your subscription settings, you can do that on this page.</p>
                </div>
            @endif

            <div class="col-span-1">
                @if(!auth()->user()->subscribed('Tuning Factory Membership', 'monthly'))
                    <x-filament::section class="mt-4">
                        <x-slot name="heading">
                            Our subscription
                        </x-slot>

                        <x-slot name="headerEnd">
                            <x-filament::modal id="subscribe-modal">
                                <x-slot name="trigger">
                                    <x-filament::button
                                        size="sm"
                                        type="button"
                                    >
                                        Subscribe to the paid plan
                                    </x-filament::button>
                                </x-slot>

                                <x-slot name="heading">
                                    Subscribe to the paid plan to get access to our API
                                </x-slot>

                                <x-slot name="footerActions">
                                    <x-filament::button
                                        type="button"
                                        wire:click="subscribe"
                                    >
                                        Subscribe to the paid plan
                                    </x-filament::button>
                                </x-slot>
                            </x-filament::modal>
                        </x-slot>

                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold">Switch to the paid plan</h3>

                                <ul class="mt-4 list-disc pl-4">
                                    <li class="text-gray-500 text-sm mb-2">10K API requests per month</li>
                                    <li class="text-gray-500 text-sm mb-2">Access to the API documentation</li>
                                    <li class="text-gray-500 text-sm mb-2">Priority support</li>
                                    <li class="text-gray-500 text-sm mb-2">A ready-to-go WordPress plugin 🌟</li>
                                </ul>
                            </div>

                            <div>
                                <p class="text-lg font-bold">€ 40,- / month</p>
                            </div>
                        </div>
                    </x-filament::section>
                @else
                    <x-filament::section class="mt-4">
                        <x-slot name="heading">
                            Manage your subscription
                        </x-slot>

                        <x-slot name="headerEnd">
                            <x-filament::button
                                type="button"
                                wire:click="billingPortal"
                            >
                                Go to the billing portal
                            </x-filament::button>
                        </x-slot>

                        <p class="text-gray-500 text-sm">Feel free to manage your subscription settings with the button above. If you have any other questions regarding your subscription, please contact us.</p>
                    </x-filament::section>
                @endif
            </div>
        </div>

        @livewire(\App\Livewire\Invoices::class)
    </div>
</x-filament-panels::page>
