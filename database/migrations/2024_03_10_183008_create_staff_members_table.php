<?php

use App\Models\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('staff_members', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name')->nullable()->comment('Имя сотрудника');
            $table->string('surname')->comment('Фамилия сотрудника');
            $table->string('patronymic')->nullable()->comment('Отчество сотрудника');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_members');
    }
};
