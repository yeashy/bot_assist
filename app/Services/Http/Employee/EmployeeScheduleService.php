<?php

namespace App\Services\Http\Employee;

use App\Models\Company;
use App\Models\EmployeeWorkingPeriod;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class EmployeeScheduleService
{
    private array $employeeIds;
    private string $date;
    private int $companyId;

    public function __construct(Request $request, int $companyId)
    {
        $this->date = $request->get('date', now()->toDateString());
        $this->employeeIds = explode(',', $request->get('employee_ids', []));
        $this->companyId = $companyId;
    }

    public function execute()
    {
        $periods = $this->getPeriods($this->date);

        $dateCarbon = CarbonImmutable::parse($this->date);

        $year = $this->getYear($dateCarbon);

        $month = $this->getMonth($dateCarbon);

        $days = $this->getDays($dateCarbon);

        return view('company.services.components.employee-schedule')->with([
            'company' => Company::query()->findOrFail($this->companyId),
            'year' => $year,
            'month' => $month,
            'days' => $days,
            'periods' => $periods,
            'employeeIds' => $this->employeeIds,
        ]);
    }

    private function getPeriods(string $date): Collection
    {
        $groupedPeriods = EmployeeWorkingPeriod::query()
            ->select([
                'id',
                'start_time',
                'employee_id',
                'date'
            ])
            ->whereIn('employee_id', $this->employeeIds)
            ->where('date', $date)
            ->get()
            ->groupBy('start_time');

        $result = collect();

        foreach ($groupedPeriods as $startTime => $periods) {
            $employeeIds = $periods->filter(function ($period) {
                return $period->is_free;
            })->pluck('employee_id')->toArray();

            $isAvailable = (bool)count($employeeIds);

            $result->push((object)[
                'start_time' => $startTime,
                'employee_ids' => implode(',', $employeeIds),
                'is_available' => $isAvailable,
                'date' => $date,
            ]);
        }

        return $result;
    }

    private function getYear(CarbonImmutable $date): int
    {
        return $date->year;
    }

    private function getMonth(CarbonImmutable $date): object
    {
        return (object)[
            'name' => $date->monthName,
            'number' => $date->month,
        ];

    }

    private function getDays(CarbonImmutable $date): array
    {
        $daysPeriod = CarbonPeriod::between($date->startOfMonth(), $date->endOfMonth());
        $days = [];

        foreach ($daysPeriod as $day) {
            $days[] = (object)[
                'name' => mb_substr($day->shortDayName, 0, -1),
                'date' => $day->toDateString(),
                'number' => $day->day,
                'is_available' => $this->isDayAvailable($day),
                'is_current' => !$day->diffInDays($date)
            ];
        }

        return $days;
    }

    private function isDayAvailable(Carbon $day): bool
    {
        if (now()->greaterThan($day->toImmutable()->endOfDay())) return false;

        return $this->getPeriods($day->toDateString())
            ->filter(function ($period) {
                return $period->is_available;
            })->isNotEmpty();
    }
}
