<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('companyDetails.name', '');
        $this->migrator->add('companyDetails.address', '');
        $this->migrator->add('companyDetails.zip', '');
        $this->migrator->add('companyDetails.houseNumber', '');
        $this->migrator->add('companyDetails.city', '');
        $this->migrator->add('companyDetails.country', '');
        $this->migrator->add('companyDetails.vatNumber', '');
        $this->migrator->add('companyDetails.iban', '');
        $this->migrator->add('companyDetails.bic', '');
        $this->migrator->add('companyDetails.bank', '');
        $this->migrator->add('companyDetails.email', '');
        $this->migrator->add('companyDetails.phone', '');
        $this->migrator->add('companyDetails.website', '');
    }
};
