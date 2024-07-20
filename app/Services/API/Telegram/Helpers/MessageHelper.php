<?php

namespace App\Services\API\Telegram\Helpers;

use Illuminate\Http\Request;

class MessageHelper
{
    public static function getMessageFromRequest(Request $request): ?object
    {
        return json_decode(json_encode($request->all()))->message;
    }
}
