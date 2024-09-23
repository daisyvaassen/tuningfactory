<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class TelegramSettings extends Settings
{
    /**
     * @var string $botToken Telegram bot token, which you can get from BotFather
     */
    public string $botToken;

    /**
     * @var int $chatId Chat ID, where you want to send the message
     */
    public int $chatId;

    public static function group(): string
    {
        return 'telegram';
    }
}
