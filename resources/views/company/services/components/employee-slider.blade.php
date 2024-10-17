<div class="flex max-w-screen w-screen overflow-x-auto gap-6 p-2 px-6 relative -left-6">
    <input
        type="radio"
        name="employee_id"
        value="any"
        id="employee_any"
        class="hidden"
    >
    @include('components.shadow-button', [
            'text' => 'Любой специалист',
            'tag' => 'label',
            'class' => 'hide_info all_employees',
            'attributes' => [
                'for' => 'employee_any'
            ],
            'dataset' => [
                'id' => implode(',', $employees->pluck('id')->toArray())
            ]
        ])

    @foreach($employees as $employee)
        <input
            type="radio"
            name="employee_id"
            value="{{ $employee->id }}"
            id="employee_{{ $employee->id }}"
            class="hidden"
        >
        @include('components.shadow-button', [
            'text' => $employee->full_name,
            'tag' => 'label',
            'class' => 'employee_button',
            'attributes' => [
                'for' => 'employee_' . $employee->id,
            ],
            'dataset' => [
                'id' => $employee->id
            ]
        ])
    @endforeach
</div>
