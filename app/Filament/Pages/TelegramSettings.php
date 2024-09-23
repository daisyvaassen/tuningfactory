<?php

namespace App\Filament\Pages;

use App\Services\TelegramService;
use App\Settings\TelegramSettings as TelegramSettingsModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Closure;

class TelegramSettings extends SettingsPage
{
    protected static string $settings = TelegramSettingsModel::class;

    protected static ?string $navigationLabel = 'Telegram';

    protected static ?string $navigationGroup = 'Settings';

    protected ?string $subheading = 'The Telegram integration allows you to receive notifications in a specified channel or chat. Notifications are sent when subscriptions are created or cancelled and whenever a payment has been done.';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('botToken')
                            ->label('Bot Token')
                            ->required()
                            ->reactive()
                            ->rules([
                                fn (): Closure => function (string $attribute, $value, Closure $fail) {
                                    if(!app()->make(\App\Contracts\TelegramServiceInterface::class)->validateBotToken($value)) {
                                        $fail('Invalid bot token');
                                    }
                                }
                            ]),

                        Forms\Components\TextInput::make('chatId')
                            ->label('Chat ID')
                            ->required()
                            ->reactive()
                            ->rules([
                                'integer',
                                fn (Forms\Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                                    $telegramService = app()->make(\App\Contracts\TelegramServiceInterface::class);
                                    $telegramService->setBotToken($get('botToken'));

                                    if (!$telegramService->validateChatId($value)) {
                                        $fail('Invalid chat ID, either the chat doesn\'t exist or the bot doesn\'t have access to it');
                                    }
                                }
                            ]),

                        Forms\Components\Actions::make([
                            Forms\Components\Actions\Action::make('send_test_message')
                                ->label('Send Test Message')
                                ->action(function (Forms\Get $get, TelegramService $telegramService): void {
                                    $telegramService->sendMessage('Test message');
                                })
                                ->hidden(fn (Forms\Get $get): bool => !$get('botToken') || !$get('chatId')),
                        ]),
                    ])
                    ->columns(3),
            ]);
    }
}
