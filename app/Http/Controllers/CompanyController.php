<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index(int $companyId): View
    {
        $company = Company::query()->findOrFail($companyId);

        return view('company.index')->with([
            'company' => $company
        ]);
    }
}
