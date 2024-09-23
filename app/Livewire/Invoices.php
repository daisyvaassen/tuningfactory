<?php

namespace App\Livewire;

use Laravel\Cashier\Order\Order;
use Livewire\Component;

class Invoices extends Component
{
    public function downloadInvoice($orderId)
    {
        $order = Order::findOrFail($orderId);
        redirect(route('invoice.download', $order));
    }

    public function render()
    {
        return view('livewire.invoices');
    }
}
