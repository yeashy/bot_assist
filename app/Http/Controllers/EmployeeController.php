<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\EmployeeWorkingPeriod;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    function info(int $companyId, int $employeeId)
    {
        $employee = Employee::query()->with('person.info')->findOrFail($employeeId);

        return view('company.services.components.employee-info')
            ->with('employee', $employee);
    }

    function schedule(Request $request, int $companyId, int $employeeId)
    {
        $date = $request->get('date', now()->toDateString());

        $employee = Employee::query()->with('periods', function ($query) use ($date) {
            $query->where('date', $date);
        })->findOrFail($employeeId);

        $periods = $employee->periods;

        $dateCarbon = CarbonImmutable::parse($date);

        $year = $dateCarbon->year;

        $month = (object)[
            'name' => $dateCarbon->monthName,
            'number' => $dateCarbon->month,
        ];

        $days = CarbonPeriod::between($dateCarbon->startOfMonth(), $dateCarbon->endOfMonth());
        $dayNames = [];

        foreach ($days as $day) {
            $dayNames[] = (object)[
                'name' => mb_substr($day->shortDayName, 0, -1),
                'date' => $day->toDateString(),
                'number' => $day->day,
                'is_free' => rand(0, 1),
                'is_current' => !$day->diffInDays($dateCarbon)
            ];
        }

        return view('company.services.components.employee-schedule')->with([
            'employee' => $employee,
            'company' => Company::query()->findOrFail($companyId),
            'year' => $year,
            'month' => $month,
            'days' => $dayNames,
            'periods' => $periods,
        ]);
    }
}
