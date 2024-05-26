<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\View\View;

class CompanyController extends Controller
{
    public function index(int $id): View
    {
        $company = Company::query()->findOrFail($id);

        return view('company.index')->with([
            'company' => $company
        ]);
    }

    public function services(int $companyId): View
    {
        $company = Company::query()->findOrFail($companyId);
        $services = $company->services;

        return view('company.services.index')->with([
            'company' => $company,
            'services' => $services
        ]);
    }
}
