<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\View\View;

class ErrorController extends Controller
{
    public function unauthorized(int $companyId): View
    {
        $company = Company::query()->findOrFail($companyId);

        return view('company.errors.403')
            ->with('company', $company);
    }
}
