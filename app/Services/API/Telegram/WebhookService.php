<?php

namespace App\Services\API\Telegram;

use Telegram\Bot\Exceptions\TelegramSDKException;

class WebhookService extends TelegramService
{
    /**
     * @throws TelegramSDKException
     */
    public function integrate(): void
    {
        $route = config('app.url') . '/api/telegram/' . $this->token . '/webhook';

        $this->telegram->setWebhook([
            'url' => $route,
        ]);
    }
}
