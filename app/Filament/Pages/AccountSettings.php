<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class AccountSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.account-settings';

    protected static bool $shouldRegisterNavigation = false;
}
