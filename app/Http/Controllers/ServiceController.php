<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobPosition;
use App\Models\Service;
use Illuminate\Contracts\View\View;

class ServiceController extends Controller
{
    public function list(int $companyId, int $positionId): View
    {
        $company = Company::query()->findOrFail($companyId);
        $position = JobPosition::query()->findOrFail($positionId);
        $services = $position->services;

        return view('company.services.list')->with([
            'position' => $position,
            'company' => $company,
            'services' => $services
        ]);
    }

    public function index(int $companyId, int $positionId, int $serviceId): View
    {
        $service = Service::query()->findOrFail($serviceId);
        $company = Company::query()->findOrFail($companyId);

        $employees = JobPosition::query()
            ->findOrFail($positionId)
            ->employees()
            ->with('person')
            ->get()
            ->unique('staff_member_id');

        return view('company.services.index')->with([
            'service' => $service,
            'employees' => $employees,
            'company' => $company
        ]);
    }
}
