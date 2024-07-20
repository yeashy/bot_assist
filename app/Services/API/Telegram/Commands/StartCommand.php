<?php

namespace App\Services\API\Telegram\Commands;

use App\Services\API\Telegram\Helpers\ButtonHelper;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected string $name = "start";
    protected string $description = "Start command";

    /**
     * @inheritDoc
     */
    public function handle(): void
    {
        $this->replyWithMessage([
            'text' => 'Пожалуйста, поделитесь своим контактом, нажав на кнопку внизу экрана',
            'reply_markup' => ButtonHelper::getContactRequestButtons()
        ]);
    }
}
