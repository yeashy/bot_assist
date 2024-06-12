<div class="rounded-2xl w-1/2 aspect-square overflow-hidden mb-2">
    <img src="{{ Storage::disk('images')->url('test.jpg') }}" alt="">
</div>
<p class="font-bold mb-2">{{ $employee->person->surname }} {{ $employee->person->name }} {{ $employee->person->patronymic }}</p>
<p class="mb-4"><span class="font-bold">Дата рождения: </span> {{ $employee->person->info->date_of_birth }} </p>
<p>{{ $employee->person->description }}</p>
