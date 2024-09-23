<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="col-span-1">
        <h2 class="text-lg font-bold mb-2">Your usage</h2>
        <p class="text-gray-500 text-sm">In our basic pricing package, we offer 10.000 API requests per month. If you need more requests, you can upgrade your plan by contacting us.</p>
    </div>

    <div class="col-span-1">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">API requests this month</p>
                    <p class="text-lg font-bold">{{ auth()->user()->api_requests_current_month }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">API requests left</p>
                    <p class="text-lg font-bold">{{ 10000 - auth()->user()->api_requests_current_month }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
