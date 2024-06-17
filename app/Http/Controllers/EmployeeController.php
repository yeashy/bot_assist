<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Services\Http\Employee\EmployeeScheduleService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function info(int $companyId, int $employeeId)
    {
        $employee = Employee::query()->with('person.info')->findOrFail($employeeId);

        return view('company.services.components.employee-info')
            ->with('employee', $employee);
    }

    public function schedule(Request $request, int $companyId)
    {
        $service = new EmployeeScheduleService($request, $companyId);
        return $service->execute();
    }
}
