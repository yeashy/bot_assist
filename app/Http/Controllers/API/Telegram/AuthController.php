<?php

namespace App\Http\Controllers\API\Telegram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function auth(Request $request, int $companyId)
    {
        Log::debug(print_r($request->all(), true));

        return response()->json([
            'message' => 'success'
        ]);
    }
}
