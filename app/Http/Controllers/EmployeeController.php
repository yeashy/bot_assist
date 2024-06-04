<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{
    function info(int $companyId, int $employeeId)
    {
        $employee = Employee::query()->with('person.info')->findOrFail($employeeId);

        return view('company.services.components.employee-info')
            ->with('employee', $employee);
    }
}
