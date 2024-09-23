<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="col-span-1">
        <h2 class="text-lg font-bold mb-2">Manage your API tokens</h2>
        <p class="text-gray-500 text-sm mb-2">Manage you API tokens here, rename them, remove them or create new ones. You can use these tokens to authenticate your API requests. If your developer needs access to your account, you can create a new token for them.</p>
        <x-filament::button
            tag="a"
            href="{{ route('l5-swagger.default.api') }}"
            target="_blank"
            color="primary"
            icon="heroicon-o-book-open"
            icon-position="before"
        >
            Read the documentation
        </x-filament::button>
    </div>

    <div class="col-span-1">
        {{ $this->table }}

        @if($plainTextToken)
            <x-filament::section class="mt-4">
                <div class="space-y-2">
                    <p class="text-sm">Token created:</p>
                    <input type="text" disabled @class(['w-full py-1 px-3 rounded-lg bg-gray-100 border-gray-200 dark:bg-gray-700 dark:border-gray-500']) name="plain_text_token" value="{{$plainTextToken}}" />
                    <div class="flex items-center justify-between">
                        <div class="inline-block text-xs">
                            <a
                                x-data="{}"
                                x-on:click.prevent="window.navigator.clipboard.writeText(@js($plainTextToken));"
                                href="#"
                                class="flex items-center"
                            >
                                @svg('heroicon-s-clipboard-document', 'w-4 mr-2')
                                <span class="">Copy to clipboard</span>
                            </a>
                        </div>

                        <x-filament::button
                            icon="heroicon-s-clipboard-document-check"
                            size="sm"
                            type="button"
                            wire:click="$set('plainTextToken',null)">I have copied the token
                        </x-filament::button>
                    </div>
                </div>
            </x-filament::section>
        @endif
    </div>
</div>
