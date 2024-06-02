<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    function info(int $employeeId): JsonResponse
    {
        $employee = Employee::query()->with('person.info')->findOrFail($employeeId);

        return response()->json($employee);
    }
}
