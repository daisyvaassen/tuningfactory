<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use App\Settings\CompanyDetailsSettings as CompanyDetailsSettingsModel;
use Filament\Forms;

class CompanyDetailsSettings extends SettingsPage
{
    protected static string $settings = CompanyDetailsSettingsModel::class;

    protected static ?string $navigationLabel = 'Company Details';

    protected static ?string $navigationGroup = 'Settings';

    protected ?string $subheading = 'These company details are used on the PDF invoices that are downloadable by your customers';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Company name')
                ->required()
                ->columnSpan(2),

            Forms\Components\TextInput::make('address')
                ->label('Company address')
                ->hintIcon('heroicon-s-information-circle')
                ->hintIconTooltip('Only use the street name here')
                ->required(),

            Forms\Components\TextInput::make('houseNumber')
                ->label('House number')
                ->required(),

            Forms\Components\TextInput::make('zip')
                ->label('ZIP code')
                ->required(),

            Forms\Components\TextInput::make('city')
                ->label('City')
                ->required(),

            Forms\Components\TextInput::make('country')
                ->label('Country')
                ->required(),

            Forms\Components\TextInput::make('vatNumber')
                ->label('VAT number')
                ->hintIcon('heroicon-s-information-circle')
                ->hintIconTooltip('Only required for companies within the EU'),

            Forms\Components\TextInput::make('iban')
                ->label('IBAN')
                ->hintIcon('heroicon-s-information-circle')
                ->hintIconTooltip('Only required for companies within the EU'),

            Forms\Components\TextInput::make('bic')
                ->label('BIC')
                ->hintIcon('heroicon-s-information-circle')
                ->hintIconTooltip('Only required for companies within the EU'),

            Forms\Components\TextInput::make('bank')
                ->label('Bank name')
                ->hintIcon('heroicon-s-information-circle')
                ->hintIconTooltip('Only required for companies within the EU'),

            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->required(),

            Forms\Components\TextInput::make('phone')
                ->label('Phone'),

            Forms\Components\TextInput::make('website')
                ->label('Website')
                ->url(),
        ])
        ->columns(2);
    }
}
