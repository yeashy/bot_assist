<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\ScheduleRequest;
use App\Models\Employee;
use App\Services\Http\Employee\EmployeeScheduleService;
use Illuminate\Contracts\View\View;

class EmployeeController extends Controller
{
    public function info(int $companyId, int $employeeId): View
    {
        $employee = Employee::query()->with('person.info')->findOrFail($employeeId);

        return view('company.services.components.employee-info')
            ->with('employee', $employee);
    }

    public function schedule(ScheduleRequest $request, int $companyId): View
    {
        $service = new EmployeeScheduleService($request, $companyId);
        return $service->execute();
    }
}
