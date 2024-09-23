<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Pages\Page;

class ApiTokens extends Page
{
    protected static ?string $navigationIcon = 'heroicon-m-link';

    protected static string $view = 'filament.pages.api-tokens';

    protected static ?string $navigationLabel = 'API';

    protected static bool $shouldRegisterNavigation = false;

    protected ?string $heading = 'API Tokens & Usage';
}
