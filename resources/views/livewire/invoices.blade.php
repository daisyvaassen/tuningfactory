<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="col-span-1">
        <h2 class="text-lg font-bold mb-2">Invoices</h2>
        <p class="text-gray-500 text-sm mb-2">See your previous invoices here, manage your upcoming invoices inside our billing portal.</p>
    </div>

    <div class="col-span-1">
        <x-filament::section class="mt-4">
            <x-slot name="heading">
                Invoices
            </x-slot>

            <div class="max-h-[300px] overflow-y-auto">
                <table class="w-full">
                    @foreach(auth()?->user()?->orders as $order)
                        @php /** @var \Laravel\Cashier\Order\Order $order */ @endphp

                        <tr>
                            <td class="text-gray-500 text-sm whitespace-nowrap pr-2">
                                {{ $order->number  }}
                            </td>

                            <td class="text-gray-500 text-sm whitespace-nowrap w-full pr-2">
                                {{ $order->processed_at->format('d-m-Y') }}
                            </td>

                            <td class="whitespace-nowrap">
                                <x-filament::button
                                    wire:click="downloadInvoice({{ $order->id  }})"
                                >
                                    Download
                                </x-filament::button>
                            </td>
                        </tr>

                        @if(!$loop->last)
                            <tr><td colspan="3" class="py-0.5"></td></tr>
                        @endif
                    @endforeach
                </table>
            </div>
        </x-filament::section>
    </div>
</div>
