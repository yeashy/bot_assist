<?php

namespace App\Services\API\Telegram\Handlers;

use App\Services\API\Telegram\Models\Message;
use App\Services\API\Telegram\TelegramService;

abstract class UpdateHandler extends TelegramService
{
    protected Message $message;

    public function __construct(string $token, array $data)
    {
        parent::__construct($token);

        $this->setInitialData($data);
    }

    public abstract function handle(): void;

    private function setInitialData(array $data): void
    {
        $this->message = new Message($data['message']);
    }
}
