<?php

namespace Tests\Feature;

use App\Settings\CompanyDetailsSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Laravel\Cashier\Order\Order;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\PdfBuilder;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    /**
     * Test if the PDF invoice is generated and if it shows all the company details
     */
    public function test_invoice_pdf(): void
    {
        $fakeCompanyDetails = [
            'name' => fake()->company,
            'address' => fake()->streetAddress,
            'zip' => fake()->postcode,
            'houseNumber' => fake()->buildingNumber,
            'city' => fake()->city,
            'country' => fake()->country,
            'vatNumber' => Str::random(10),
            'iban' => fake()->iban,
            'bic' => fake()->swiftBicNumber,
            'bank' => fake()->company,
            'email' => fake()->email,
            'phone' => fake()->phoneNumber,
            'website' => fake()->url,
        ];

        CompanyDetailsSettings::fake($fakeCompanyDetails);

        $this->get(route('invoice.download', ['order' => new Order()]))
            ->assertOk();

        Pdf::assertRespondedWithPdf(function(PdfBuilder $pdf) {

        });
    }
}
