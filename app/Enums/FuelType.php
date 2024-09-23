<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum FuelType: string implements HasLabel
{
    case Petrol = 'petrol';
    case Diesel = 'diesel';
    case Electric = 'electric';
    case Hybrid = 'hybrid';
    case PluginHybrid = 'plugin_hybrid';
    case Hydrogen = 'hydrogen';
    case Lpg = 'lpg';
    case Cng = 'cng';
    case Other = 'other';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Petrol => 'Petrol',
            self::Diesel => 'Diesel',
            self::Electric => 'Electric',
            self::Hybrid => 'Hybrid',
            self::PluginHybrid => 'Plugin Hybrid',
            self::Hydrogen => 'Hydrogen',
            self::Lpg => 'LPG',
            self::Cng => 'CNG',
            self::Other => 'Other',
        };
    }
}
