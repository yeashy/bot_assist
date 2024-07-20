<?php

namespace App\Services\API\Telegram\Handlers;

use App\Services\API\Telegram\Commands\StartCommand;
use App\Services\API\Telegram\Helpers\ButtonHelper;
use App\Services\API\Telegram\Helpers\CommandHelper;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;

class CommandHandler extends UpdateHandler
{
    /**
     * @throws TelegramSDKException
     */
    public function handle(): void
    {
        $telegram = new Api($this->token);
        CommandHelper::registerCommands($telegram);

        $telegram->commandsHandler(true);
    }
}
