<?php

use App\Models\Client;
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
        Schema::create('client_describing_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Client::class)->unique()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('photo_path')->nullable()->comment('Фотография клиента');
            $table->date('date_of_birth')->nullable()->comment('Дата рождения клиента');
            $table->string('address')->nullable()->comment('Домашний адрес клиента');
            $table->text('description')->nullable()->comment('Доп. информация о клиенте');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_describing_infos');
    }
};
