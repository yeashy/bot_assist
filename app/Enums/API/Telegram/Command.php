<?php

namespace App\Enums\API\Telegram;

enum Command: string
{
    case Start = 'start';
    case Login = 'login';
}
