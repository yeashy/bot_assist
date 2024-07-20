<?php

namespace App\Services\API\Telegram;

use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;

class TelegramService
{
    protected Api $telegram;

    /**
     * @throws TelegramSDKException
     */
    public function __construct(
        protected string $token
    )
    {
        $this->telegram = new Api($this->token);
    }
}
