<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin')->name('login');
Route::get('/download-invoice/{order}', [App\Http\Controllers\DownloadInvoiceController::class, '__invoke'])->name('invoice.download');

//Route::get('download-invoice/{orderId}', [App\Http\Controllers\InvoiceController::class, 'downloadInvoice'])->name('download-invoice');

Route::get('test', function() {
    // Get api usages where date is in current month and sum the request_count. Only get users with more than 10K requests
    \App\Jobs\ChargeOverusage::dispatch();
});
