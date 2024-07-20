<?php

namespace App\Enums\API\Telegram;

enum HandlerTypes
{
    case Command;
    case Message;
}
