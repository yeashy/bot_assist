<?php

namespace App\Services\Http\API\Telegram\Auth;

use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

readonly class AuthService
{
    public function __construct(
        private Request $request,
        private int     $companyId,
        private string  $encodingKey = 'WebAppData'
    ) {}

    public function execute(): JsonResponse
    {
        $checkHash = $this->request->get('hash');

        $checkString = $this->getCheckString($this->request->all());

        $realHash = $this->getHashFromData($checkString, $this->companyId);

        Log::debug($checkString . PHP_EOL . $realHash . PHP_EOL . hash_equals($checkHash, $realHash));

        return response()->json([
            'message' => hash_equals($checkHash, $realHash) ? 'success' : 'error',
        ]);
    }

    private function getHashFromData(string $checkString, int $companyId): string
    {
        $botToken = Company::query()->where('id', $companyId)->value('bot_token');

        $botToken = hash_hmac('sha256', $botToken, $this->encodingKey, true);
        return hash_hmac('sha256', $checkString, $botToken);
    }

    private function getCheckString(array $data): string
    {
        unset($data['hash']);

        $query_id = str_replace('query_id=', '', $data['tgWebAppData']);
        $auth_date = $data['auth_date'];
        $user = urldecode($data['user']);

        $data = compact('query_id', 'auth_date', 'user');
        ksort($data);

        $check_string = '';
        foreach ($data as $key => $value) {
            $check_string .= "$key=$value\n";
        }

        return rtrim($check_string, "\n");
    }
}
