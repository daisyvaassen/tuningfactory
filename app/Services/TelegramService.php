<?php

namespace App\Services;

use App\Contracts\TelegramServiceInterface;
use App\Settings\TelegramSettings;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class TelegramService implements TelegramServiceInterface
{
    /**
     * @var string $botToken Telegram bot token, which you can get from BotFather
     */
    protected string $botToken;

    /**
     * @var int $chatId Chat ID, where you want to send the message
     */
    protected int $chatId;

    public function __construct()
    {
        $this->botToken = app(TelegramSettings::class)->botToken;
        $this->chatId = app(TelegramSettings::class)->chatId;
    }

    public function setBotToken($botToken): void
    {
        if(!$this->validateBotToken($botToken)) {
            throw new \Exception('Invalid bot token');
        }

        $this->botToken = $botToken;
    }

    public function sendMessage($message): bool
    {
        if(!$this->botToken || !$this->chatId) {
            throw new \Exception('Bot token and chat ID are required to send messages');
        }

        $response = Http::post("https://api.telegram.org/bot{$this->botToken}/sendMessage", [
            'chat_id' => $this->chatId,
            'text' => $message,
        ]);

        if($response->failed()) {
            Log::error('Failed to send message to Telegram: ' . $response->body());
            return false;
        }

        return true;
    }

    public function validateBotToken($botToken): bool
    {
        $response = Http::get("https://api.telegram.org/bot{$botToken}/getMe");

        if($response->failed()) {
            Log::error('Failed to validate bot token: ' . $response->body());
            return false;
        }

        return true;
    }

    public function validateChatId($chatId): bool
    {
        $response = Http::post("https://api.telegram.org/bot{$this->botToken}/getChat", [
            'chat_id' => $chatId,
        ]);

        if($response->failed()) {
            Log::error('Failed to validate chat ID: ' . $response->body());
            return false;
        }

        return true;
    }
}
