<?php

namespace App\Services\API\Telegram;

use Illuminate\Http\Request;

class AuthService extends TelegramService
{
    private string $hash;

    public function __construct(Request $request, string $token)
    {
        parent::__construct($token);

        $this->hash = $request->get('hash');
    }

    public function execute()
    {
        dd($this->hash);
    }
}
