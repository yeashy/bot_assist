<?php

namespace App\Services\Http\Employee;

use App\Models\EmployeeWorkingPeriod;
use App\Models\Service;
use App\Models\ServiceAssignment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignService
{
    private int $serviceId;
    private int $employeeWorkingPeriodId;
    private int $clientId;

    public function __construct(Request $request, int $companyId)
    {
        $this->serviceId = $request->get('service_id');
        $this->employeeWorkingPeriodId = $request->get('employee_working_period_id');
        $this->clientId = Auth::user()->client($companyId)->id;
    }

    public function execute()
    {
        $service = Service::query()->find($this->serviceId);
        $num = $this->calculatePeriodsCount($service->allocated_time);

        $assignment = new ServiceAssignment();

        $assignment->service_id = $this->serviceId;
        $assignment->employee_working_period_id = $this->employeeWorkingPeriodId;
        $assignment->client_id = $this->clientId;

        $assignment->save();
    }

    private function calculatePeriodsCount(string $allocatedTime)
    {
        $end = Carbon::parse($allocatedTime);

        $diff = $end->diffInMinutes(now());

        dd(now()->toDateTimeString(), $end->toDateString(), $diff);
    }
}
