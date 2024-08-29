<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\MeRequest;
use App\Models\Company;
use App\Models\User;
use App\Services\Http\User\MeService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request, int $companyId): View
    {
        $company = Company::query()->findOrFail($companyId);

        return view('user.index')->with([
                'company' => $company,
            ]);
    }

    public function me(MeRequest $request): JsonResponse
    {
        $service = new MeService($request);

        return $service->execute();
    }
}
