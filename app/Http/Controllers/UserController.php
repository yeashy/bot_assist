<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request, int $companyId)
    {
        $company = Company::query()->findOrFail($companyId);

        return view('user.index')->with([
                'company' => $company,
            ]);
    }

    public function me(Request $request)
    {
        return response()->json(Auth::user()->toArray());
    }
}
