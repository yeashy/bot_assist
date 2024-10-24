<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table): void {
            $table->id();
            $table->string('encoded_id')->comment('Закодированное айди, для безопасности');
            $table->string('name')->comment('Название компании');
            $table->string('code_name')->comment('Кодовое имя (англ, без пробелов и спец. символов)');
            $table->string('bot_token')->comment('Токен бота из телеграм');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
}
