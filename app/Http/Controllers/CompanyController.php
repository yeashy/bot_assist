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

    public function positions(int $companyId): View
    {
        $company = Company::query()->findOrFail($companyId);

        $positions = $company->positions;

        return view('company.job-positions.index')->with([
            'company' => $company,
            'positions' => $positions
        ]);
    }

    public function services(int $companyId, int $positionId): View
    {
        $company = Company::query()->findOrFail($companyId);
        $position = JobPosition::query()->findOrFail($positionId);
        $services = $position->services;

        return view('company.services.index')->with([
            'position' => $position,
            'company' => $company,
            'services' => $services
        ]);
    }
}
