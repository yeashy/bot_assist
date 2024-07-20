<?php

namespace App\Services\API\Telegram\Helpers\Factories;

use App\Enums\API\Telegram\HandlerTypes;
use App\Services\API\Telegram\Handlers\CommandHandler;
use App\Services\API\Telegram\Handlers\MessageHandler;
use App\Services\API\Telegram\Handlers\UpdateHandler;
use Telegram\Bot\Exceptions\TelegramSDKException;

class HandlerFactory
{
    /**
     * @throws TelegramSDKException
     */
    public static function make(HandlerTypes $type, array $params): UpdateHandler
    {
        return match ($type) {
            HandlerTypes::Command => new CommandHandler($params['token'], $params['data']),
            HandlerTypes::Message => new MessageHandler($params['token'], $params['data'])
        };
    }
}
