<?php

namespace App\Services\Models;

use App\Models\Client;
use App\Models\EmployeeWorkingPeriod;
use App\Models\Service;
use Carbon\Carbon;

readonly class EmployeeWorkingPeriodService
{
    public function __construct(
        private EmployeeWorkingPeriod $employeeWorkingPeriod
    ) {}

    public function createAssignment(Service $service, Client $client): void
    {
        $this->employeeWorkingPeriod->assignment()->create([
            'service_id' => $service->id,
            'client_id' => $client->id
        ]);
    }

    public function isAvailableToAssign(Service $service): bool
    {
        $periodsCount = $this->calculatePeriodsCount($service->allocated_time);

        return
            $this->employeeWorkingPeriod->is_free
            && $this->isPeriodsCountEnough($periodsCount);
    }

    public function isPeriodsCountEnough(int $count): bool
    {
        $period = $this->employeeWorkingPeriod;

        for ($i = 1; $i < $count; $i++) {
            $nextPeriod = $this->getNextPeriod($period);

            if (empty($nextPeriod?->is_free)) {
                return false;
            }

            $period = $nextPeriod;
        }

        return true;
    }

    private function isNextPeriodFree(EmployeeWorkingPeriod $employeeWorkingPeriod): bool
    {
        return $this->getNextPeriod($employeeWorkingPeriod)?->is_free ?? false;
    }

    private function getNextPeriod(?EmployeeWorkingPeriod $employeeWorkingPeriod): ?EmployeeWorkingPeriod
    {
        if (empty($employeeWorkingPeriod)) {
            return null;
        }

        /** @var EmployeeWorkingPeriod|null $period */
        $period = EmployeeWorkingPeriod::query()
            ->where('employee_id', $employeeWorkingPeriod->employee_id)
            ->whereDate('date', $employeeWorkingPeriod->date)
            ->whereTime('start_time', $employeeWorkingPeriod->end_time)
            ->first();

        return $period;
    }

    private function calculatePeriodsCount(string $allocatedTime): int
    {
        $start = now()->startOfDay();
        $end = Carbon::parse($allocatedTime);

        return $end->diffInMinutes($start) / 15;
    }
}
