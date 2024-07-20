<?php

namespace App\Services\API\Telegram\Helpers;

use Telegram\Bot\Keyboard\Keyboard;

class ButtonHelper
{
    public static function getContactRequestButtons(): Keyboard
    {
        return Keyboard::make()
            ->setOneTimeKeyboard(true)
            ->row([
                Keyboard::button([
                    'text' => 'Поделиться контактом',
                    'request_contact' => true,
                    'callback_data' => '/contact'
                ])
            ]);
    }
}
