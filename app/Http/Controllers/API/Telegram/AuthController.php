<?php

namespace App\Http\Controllers\API\Telegram;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function auth(Request $request, int $companyId): JsonResponse
    {
        $data = $request->all();
        $check_hash = $data['hash'];

        unset($data['hash']);

        $query_id = str_replace('query_id=', '', $data['tgWebAppData']);
        $auth_date = $data['auth_date'];
        $user = $data['user'];

        $data = compact('query_id', 'auth_date', 'user');
        ksort($data);

        $check_string = '';
        foreach ($data as $key => $value) {
            $check_string .= "$key=$value\n";
        }

        $check_string = rtrim($check_string, "\n");

        $botToken = Company::query()->where('id', $companyId)->value('bot_token');

        $botToken = hash_hmac('sha256', $botToken, "WebAppData");
        $encodedHash = hash_hmac('sha256', $check_string, $botToken);

        Log::debug(print_r($data, true));
        Log::debug($check_hash . PHP_EOL . $encodedHash . PHP_EOL . hash_equals($check_string, $encodedHash));

        return response()->json([
            'message' => 'success'
        ]);
    }
}
