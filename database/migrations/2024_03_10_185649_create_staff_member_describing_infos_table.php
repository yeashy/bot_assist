<?php

use App\Models\StaffMember;
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
        Schema::create('staff_member_describing_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StaffMember::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('photo_path')->nullable()->comment('Фотография сотрудника');
            $table->string('phone_number')->nullable()->comment('Номер телефона сотрудника');
            $table->date('date_of_birth')->nullable()->comment('Дата рождения сотрудника');
            $table->text('description')->nullable()->comment('Доп. информация о сотруднике');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_member_describing_infos');
    }
};
