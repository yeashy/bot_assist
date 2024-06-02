<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobPosition;
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
}
