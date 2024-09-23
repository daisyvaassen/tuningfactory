<?php

namespace App\Http\Controllers;

use App\Settings\CompanyDetailsSettings;
use Illuminate\Http\Request;
use Laravel\Cashier\Order\Order;
use Spatie\LaravelPdf\Facades\Pdf;

class DownloadInvoiceController extends Controller
{
    public function __invoke(Order $order)
    {
        $companyDetails = app(CompanyDetailsSettings::class);

        return Pdf::view('pdfs.invoice', compact('order', 'companyDetails'))
            ->format('a4')
            ->save('invoice.pdf');
    }
}
