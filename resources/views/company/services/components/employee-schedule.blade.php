@php use Carbon\Carbon; @endphp
<div class="w-full mb-4 calendar">
    <div class="bg-company p-4 rounded-2xl box-shadow-basic">

        <!-- Переключение месяца -->
        <div class="flex justify-between items-center mb-2">
            @if(!$months->previous->disabled)
                <form action="/companies/{{ $company->id }}/employees/schedule" id="employee_schedule_form" data-full="1">
                    <input type="hidden" name="date" value="{{ $months->previous->date }}">
                    <input type="hidden" name="employee_ids" value="{{ implode(',', $employeeIds) }}">
                    <button class="additional-block-company px-3 py-2 rounded">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                </form>
            @else
                <button class="additional-block-company px-3 py-2 rounded opacity-50" disabled>
                    <i class="fa fa-arrow-left"></i>
                </button>
            @endif

            <h2 class="text-lg font-bold capitalize">{{ $month->name }} {{ $year }}</h2>
            <form action="/companies/{{ $company->id }}/employees/schedule" id="employee_schedule_form" data-full="1">
                <input type="hidden" name="date" value="{{ $months->next->date }}">
                <input type="hidden" name="employee_ids" value="{{ implode(',', $employeeIds) }}">
                <button class="additional-block-company px-3 py-2 rounded">
                    <i class="fa fa-arrow-right"></i>
                </button>
            </form>
        </div>

        <div class="mb-2 box-shadow-inner-basic rounded">
            <div class="flex space-x-2 p-2 overflow-x-auto">
                @foreach($days as $day)
                    @if($day->is_available)
                        <form id="employee_schedule_form" action="/companies/{{ $company->id }}/employees/schedule" method="GET">
                            <input type="hidden" name="date" value="{{ $day->date }}">
                            <input type="hidden" name="employee_ids" value="{{ implode(',', $employeeIds) }}">
                            <button
                                type="submit" {{-- TODO: система цветов будет переработа - это костыль (active) --}}
                                class="flex flex-col items-center additional-block-company shadow px-4 pt-1 rounded min-w-max day @if($day->is_current) active @endif"
                            >
                                <span class="text-sm capitalize">{{ $day->name }}</span>
                                <span class="text-lg font-bold">{{ $day->number }}</span>
                            </button>
                        </form>
                    @else
                        <div
                            class="flex flex-col items-center px-4 pt-1 min-w-max"
                        >
                            <span class="text-sm capitalize">{{ $day->name }}</span>
                            <span class="text-lg font-bold">{{ $day->number }}</span>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="px-2 rounded box-shadow-inner-basic periods h-[35vh]">
            <div class="grid grid-cols-4 gap-2 gap-y-0 h-full text-center overflow-y-auto pb-2">
                @foreach($periods as $period)
                    <div class="py-2 mt-2 @if($period->is_available) additional-block-company @else bg-none @endif rounded">
                        {{ Carbon::parse($period->start_time)->format('H:i') }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
