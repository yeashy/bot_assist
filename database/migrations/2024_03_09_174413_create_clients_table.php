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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name')->nullable()->comment('Имя клиента');
            $table->string('surname')->comment('Фамилия клиента');
            $table->string('patronymic')->comment('Отчество клиента');
            $table->string('phone_number')->comment('Номер телефона клиента');
            $table->string('remember_token')->nullable()->comment('Токен клиента (для авторизации)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
