<?php

namespace App\Services\Http\API\Telegram\Webhook;

use App\Enums\API\Telegram\HandlerTypes;
use App\Services\API\Telegram\Commands\StartCommand;
use App\Services\API\Telegram\Handlers\MessageHandler;
use App\Services\API\Telegram\Handlers\UpdateHandler;
use App\Services\API\Telegram\Helpers\CommandHelper;
use App\Services\API\Telegram\Helpers\Factories\HandlerFactory;
use App\Services\API\Telegram\Helpers\MessageHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

readonly class HandleService
{
    public function __construct(
        private Request $request,
        private string  $token
    )
    {
    }

    public function execute(): JsonResponse
    {
        Log::debug(print_r($this->request->all(), true));

        $handlerType = HandlerTypes::Message;

        $message = MessageHelper::getMessageFromRequest($this->request);
        $commands = $message ? CommandHelper::getCommandsFromMessage($message) : [];

        if (count($commands)) {
            $handlerType = HandlerTypes::Command;
        }

        $handler = HandlerFactory::make($handlerType, [
            'token' => $this->token,
            'data' => $this->request->all(),
        ]);

        $handler->handle();

        return response()->json([
            'message' => 'success',
        ]);
    }
}
