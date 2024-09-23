<x-filament-panels::page>
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

    <div class="space-y-6">
        @livewire(\App\Livewire\SanctumTokens::class)

        @livewire(\App\Livewire\UserApiRequestsStats::class)
    </div>
</x-filament-panels::page>
