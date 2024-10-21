<?php

namespace App\Services\Http\Assignment;

use App\Models\Client;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class NextService
{
    private Client $client;

    public function __construct(
        int $companyId
    )
    {
        /** @var User $user */
        $user = Auth::user();

        $this->client = $user->client($companyId);
    }

    public function execute(): View
    {
        $assignment = $this->client->assignments()
            ->join(
                'employee_working_periods',
                'service_assignments.employee_working_period_id',
                '=',
                'employee_working_periods.id'
            )
            ->where('employee_working_periods.date', '>', now()->toDateString())
            ->orWhere(function (Builder $query) {
                $query
                    ->where('employee_working_periods.date', '=', now()->toDateString())
                    ->where('employee_working_periods.start_time', '>=', now()->toDateString());
            })
            ->orderBy('employee_working_periods.date')
            ->orderBy('employee_working_periods.start_time')
            ->select(
                'service_assignments.*',
                'employee_working_periods.date',
                'employee_working_periods.start_time'
            )
            ->with('period.employee.person', 'service')
            ->first();

        return view('company.index.next-assignment', [
            'assignment' => $assignment,
        ]);
    }
}
