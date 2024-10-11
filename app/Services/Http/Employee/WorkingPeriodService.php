<?php

namespace App\Services\Http\Employee;

use App\Models\EmployeeWorkingPeriod;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkingPeriodService
{
    private CarbonInterface $datetime;
    private int $employeeId;

    public function __construct(Request $request, int $employeeId)
    {
        $this->datetime = Carbon::parse(
            $request->get('date')
            . ' '
            . $request->get('time')
        );

        $this->employeeId = $employeeId;
    }

    public function execute(): JsonResponse
    {
        $date = $this->datetime->toDateString();
        $time = $this->datetime->toTimeString();

        $workingPeriod = EmployeeWorkingPeriod::query()
            ->where('employee_id', $this->employeeId)
            ->where('date', $date)
            ->where('start_time', $time)
            ->first();

        return response()->json([
            'employee_working_period_id' => $workingPeriod->id,
            'company_affiliate_address' => $workingPeriod->employee->affiliate->address,
        ]);
    }
}
