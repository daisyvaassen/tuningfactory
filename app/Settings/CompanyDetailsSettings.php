<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CompanyDetailsSettings extends Settings
{
    /**
     * @var string $name Company name
     */
    public string $name;

    /**
     * @var string $address Company address
     */
    public string $address;

    /**
     * @var string $zip Company ZIP code
     */
    public string $zip;

    /**
     * @var string $houseNumber Company house number
     */
    public string $houseNumber;

    /**
     * @var string $city Company city
     */
    public string $city;

    /**
     * @var string $country Company country
     */
    public string $country;

    /**
     * @var ?string $vatNumber Company VAT number
     */
    public ?string $vatNumber;

    /**
     * @var ?string $iban Company IBAN
     */
    public ?string $iban;

    /**
     * @var ?string $bic Company BIC
     */
    public ?string $bic;

    /**
     * @var ?string $bank Company bank name
     */
    public ?string $bank;

    /**
     * @var string $email Company email
     */
    public string $email;

    /**
     * @var ?string $phone Company phone number
     */
    public ?string $phone;

    /**
     * @var ?string $website Company website
     */
    public ?string $website;

    public static function group(): string
    {
        return 'companyDetails';
    }
}
