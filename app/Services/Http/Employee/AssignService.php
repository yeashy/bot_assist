<?php

namespace App\Services\Http\Employee;

use App\Models\Client;
use App\Models\EmployeeWorkingPeriod;
use App\Models\Service;
use App\Models\ServiceAssignment;
use App\Models\User;
use App\Services\Models\EmployeeWorkingPeriodService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AssignService
{
    private int $serviceId;
    private Client $client;
    private ?EmployeeWorkingPeriod $employeeWorkingPeriod;

    public function __construct(Request $request, int $companyId, int $employeeWorkingPeriodId)
    {
        $this->serviceId = $request->get('service_id');

        /** @var User $user */
        $user = Auth::user();
        $this->client = $user->client($companyId);

        $this->employeeWorkingPeriod = EmployeeWorkingPeriod::query()->find($employeeWorkingPeriodId);
    }

    public function execute()
    {
        $modelService = new EmployeeWorkingPeriodService($this->employeeWorkingPeriod);
        /** @var Service $service */
        $service = Service::query()->find($this->serviceId);

        if (
            $modelService->isAvailableToAssign($service)
        ) {
            $modelService->createAssignment($service, $this->client);
            return response()->json([
                'message' => 'success'
            ]);
        } else {
            return response()->json([
                'message' => 'Не получилось оформить запись! Время уже занято.'
            ])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
