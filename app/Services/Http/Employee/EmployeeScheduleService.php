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

    private CarbonImmutable $activeDate;

    public function __construct(Request $request, int $companyId)
    {
        $this->date = $request->get('date', now()->toDateString());
        $this->employeeIds = explode(',', $request->get('employee_ids', []));
        $this->companyId = $companyId;

        $this->setActiveDate();
    }

    public function execute()
    {
        $periods = $this->getPeriods();

        $year = $this->getYear();

        $month = $this->getMonth();
        $months = $this->getOtherMonths();

        $days = $this->getDays();

        return view('company.services.components.employee-schedule')->with([
            'company' => Company::query()->findOrFail($this->companyId),
            'year' => $year,
            'month' => $month,
            'months' => $months,
            'days' => $days,
            'periods' => $periods,
            'employeeIds' => $this->employeeIds,
        ]);
    }

    private function getPeriods(): Collection
    {
        $groupedPeriods = EmployeeWorkingPeriod::query()
            ->select([
                'id',
                'start_time',
                'employee_id',
                'date'
            ])
            ->whereIn('employee_id', $this->employeeIds)
            ->where('date', $this->activeDate)
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
                'date' => $this->activeDate,
            ]);
        }

        return $result;
    }

    private function setActiveDate(): void
    {
        $date = CarbonImmutable::parse($this->date);

        $this->activeDate = $date->endOfDay()->lessThan(now()) ? CarbonImmutable::now() : $date;
    }

    private function getYear(): int
    {
        return $this->activeDate->year;
    }

    private function getOtherMonths(): object
    {
        $previousMonth = $this->activeDate->subMonth()->startOfMonth();
        $nextMonth = $this->activeDate->addMonth()->startOfMonth();

        $previous = [
            'disabled' => true,
            'date' => $previousMonth->format('Y-m-d'),
        ];

        $next = [
            'disabled' => false,
            'date' => $nextMonth->format('Y-m-d'),
        ];

        if ($previousMonth->endOfMonth()->greaterThan(now())) {
            $previous['disabled'] = false;
        }

        return (object)[
            'previous' => (object)$previous,
            'next' => (object)$next,
        ];
    }

    private function getMonth(): object
    {
        return (object)[
            'name' => $this->activeDate->monthName,
            'number' => $this->activeDate->month,
        ];

    }

    private function getDays(): array
    {
        $daysPeriod = CarbonPeriod::between($this->activeDate->startOfMonth(), $this->activeDate->endOfMonth());
        $days = [];

        foreach ($daysPeriod as $day) {
            $days[] = (object)[
                'name' => mb_substr($day->shortDayName, 0, -1),
                'date' => $day->toDateString(),
                'number' => $day->day,
                'is_available' => $this->isDayAvailable($day),
                'is_current' => $day->startOfDay()->equalTo($this->activeDate->startOfDay())
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