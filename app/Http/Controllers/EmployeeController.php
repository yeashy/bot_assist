<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\AssignRequest;
use App\Http\Requests\Employee\ScheduleRequest;
use App\Http\Requests\Employee\WorkingPeriodRequest;
use App\Models\Employee;
use App\Models\EmployeeWorkingPeriod;
use App\Services\Http\Employee\AssignService;
use App\Services\Http\Employee\EmployeeScheduleService;
use App\Services\Http\Employee\WorkingPeriodService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function workingPeriod(WorkingPeriodRequest $request, int $companyId, int $employeeId): JsonResponse
    {
        $service = new WorkingPeriodService($request, $employeeId);
        return $service->execute();
    }

    public function assign(AssignRequest $request, int $companyId, int $employeeWorkingPeriodId): JsonResponse
    {
        $service = new AssignService($request, $companyId, $employeeWorkingPeriodId);
        return $service->execute();
    }
}
