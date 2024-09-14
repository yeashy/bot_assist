<?php

namespace App\Services\Http\API\Telegram\Auth;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

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

        if (hash_equals($checkHash, $realHash)) {
            $telegramUser = json_decode($this->request->get('user'), true);
            $user = new \App\Services\API\Telegram\Models\User($telegramUser);

            $userModel = User::query()->firstOrCreate([
                'external_id' => $user->id
            ], [
                'name' => $user->username ?? null,
            ]);

            $this->loginUser($userModel);

            $response = [
                'message' => 'success'
            ];

            $statusCode = Response::HTTP_OK;
        } else {
            $response = [
                'message' => 'error'
            ];

            $statusCode = Response::HTTP_UNAUTHORIZED;
        }

        return response()->json($response, $statusCode);
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

        $query_id = $data['query_id'];
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

    private function loginUser(User $user): void
    {
        Auth::login($user);

        Log::info('User is logged. ' . Auth::user()?->id . ' | ' . microtime(true));
    }
}
