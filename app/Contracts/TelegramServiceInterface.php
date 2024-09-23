<?php

namespace App\Contracts;

interface TelegramServiceInterface
{
    public function sendMessage($message): bool;

    public function setBotToken($botToken): void;

    public function validateBotToken($botToken): bool;

    public function validateChatId($chatId): bool;
}
