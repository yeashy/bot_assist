<div class="flex max-w-screen w-screen overflow-x-auto gap-6 p-2 px-6 relative -left-6 aspect-[5/2]">
    @foreach($employees as $employee)
        @include('components.shadow-button', [
            'text' => $employee->full_name,
            'tag' => 'button',
            'class' => 'employee_button',
            'dataset' => [
                'id' => $employee->id
            ]
        ])
    @endforeach
</div>
