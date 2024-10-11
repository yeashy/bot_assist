@php use Carbon\Carbon; @endphp
<div class="w-full mb-4 calendar">
    <div class="bg-company p-4 rounded-2xl shadow-company">

        <!-- Переключение месяца -->
        <div class="flex justify-between items-center mb-2">
            @if(!$months->previous->disabled)
                <form action="/companies/{{ $company->id }}/employees/schedule" id="employee_schedule_form" data-full="1">
                    <input type="hidden" name="date" value="{{ $months->previous->date }}">
                    <input type="hidden" name="employee_ids" value="{{ '[' . implode(',', $employeeIds) . ']'}}">
                    <button class="block-company px-3 py-2 rounded">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                </form>
            @else
                <button class="block-company px-3 py-2 rounded opacity-50" disabled>
                    <i class="fa fa-arrow-left"></i>
                </button>
            @endif

            <h2 class="text-lg font-bold capitalize">{{ $month->name }} {{ $year }}</h2>
            @if(!$months->next->disabled)
                <form action="/companies/{{ $company->id }}/employees/schedule" id="employee_schedule_form" data-full="1">
                    <input type="hidden" name="date" value="{{ $months->next->date }}">
                    <input type="hidden" name="employee_ids" value="{{ '[' . implode(',', $employeeIds) . ']' }}">
                    <button class="block-company px-3 py-2 rounded">
                       <i class="fa fa-arrow-right"></i>
                    </button>
                </form>
            @else
                    <button class="block-company px-3 py-2 rounded opacity-50" disabled>
                        <i class="fa fa-arrow-right"></i>
                    </button>
            @endif
        </div>

        <div class="mb-2 shadow-company-inner rounded">
            <div class="flex space-x-2 p-2 overflow-x-auto">
                @foreach($days as $day)
                    @if($day->is_available)
                        <form id="employee_schedule_form" action="/companies/{{ $company->id }}/employees/schedule" method="GET">
                            <input type="hidden" name="date" value="{{ $day->date }}">
                            <input type="hidden" name="employee_ids" value="{{ '[' . implode(',', $employeeIds) . ']' }}">
                            <button
                                type="submit" {{-- TODO: система цветов будет переработа - это костыль (active, shadow) --}}
                                class="flex flex-col items-center block-company shadow-company-sm px-4 pt-1 rounded min-w-max day @if($day->is_current) active @endif"
                            >
                                <span class="text-sm capitalize">{{ $day->name }}</span>
                                <span class="text-lg font-bold">{{ $day->number }}</span>
                            </button>
                        </form>
                    @else
                        <div
                            class="flex flex-col items-center px-4 pt-1 min-w-max block-company opacity-50"
                        >
                            <span class="text-sm capitalize">{{ $day->name }}</span>
                            <span class="text-lg font-bold">{{ $day->number }}</span>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="px-2 rounded shadow-company-inner periods h-[35vh]">
            <div class="grid grid-cols-4 gap-1 gap-y-0 h-full text-center overflow-y-auto pb-2">
                @foreach($periods as $period)
                    <button
                        data-date="{{ Carbon::parse($period->date)->format('d.m.Y') }}"
                        data-time="{{ $period->start_time }}"
                        data-employee-ids="{{ implode(',', $employeeIds) }}"
                        data-employee-names="{{ implode(',', $employeeNames) }}"
                        @if(!empty($employee))
                            data-person-name="{{ $employee->person->full_name }}"
                            data-address="{{ $employee->affiliate->address }}"
                        @endif
                        class="assign_to_service py-2 mt-2 block-company mx-1 @if($period->is_available) modal-toggle shadow-company-sm @else opacity-50 @endif rounded"
                        data-modal="assignment-to-service-modal"
                        onclick="assignToService(this)"
                    >
                        {{ $period->start_time}}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</div>

