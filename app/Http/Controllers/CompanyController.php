<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\View\View;

class CompanyController extends Controller
{
    public function index(int $companyId): View
    {
        $company = Company::findOrFail($companyId);

        return view('company.index')->with([
            'company' => $company
        ]);
    }
}
