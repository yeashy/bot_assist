<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\MeRequest;
use App\Models\Company;
use App\Services\Http\User\MeService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
