<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('telegram.botToken', '');
        $this->migrator->add('telegram.chatId', 0);
    }
};
