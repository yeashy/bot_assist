<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\View\View;

class JobPositionController extends Controller
{
    public function list(int $companyId): View
    {
        $company = Company::query()->findOrFail($companyId);

        $positions = $company->positions;

        return view('company.job-positions.list')->with([
            'company' => $company,
            'positions' => $positions
        ]);
    }
}
