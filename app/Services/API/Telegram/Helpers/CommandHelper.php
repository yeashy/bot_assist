<?php

namespace App\Services\API\Telegram\Helpers;

use Telegram\Bot\Api;

class CommandHelper
{
    public static function getCommandsFromMessage(object $message): array
    {
        if (empty($message->entities)) {
            return [];
        }

        $commandsList =  array_filter($message->entities, function ($entity) {
            $entity = (object)$entity;
            return $entity->type === 'bot_command';
        });

        $commands = [];

        foreach ($commandsList as $command) {
            $command = (object)$command;
            $commands[] = substr($message->text, $command->offset, $command->length);
        }

        return $commands;
    }

    public static function registerCommands(Api $telegram): void
    {
        $commands = config('telegram.commands');

        $telegram->addCommands($commands);
    }
}
