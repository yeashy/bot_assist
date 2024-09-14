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
        Schema::dropIfExists('company_design_infos');

        Schema::create('company_design_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('primary_color')->default('#ffffff')->comment('Основной цвет');
            $table->string('secondary_color')->default('#000000')->comment('Вторичный цвет');
            $table->string('accent_color')->default('#000000')->comment('Цвет акцента');
            $table->string('background_color')->default('#ffffff')->comment('Цвет фона');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_design_infos');

        Schema::create('company_design_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('background_color')->default('#ffffff')->comment('Цвет основного фона');
            $table->string('text_color')->default('#000000')->comment('Цвет основного шрифта');
            $table->string('border_color')->default('#000000')->comment('Цвет основных границ');

            $table->string('block_background_color')->default('#ffffff')->comment('Цвет основных блоков');
            $table->string('button_background_color')->default('#000000')->comment('Цвет кнопок');
            $table->string('main_background_color')->default('#ffffff')->comment('Цвет главного блока');
            $table->string('additional_background_color')->default('#ffffff')->comment('Цвет доп. блоков');

            $table->string('button_text_color')->default('#ffffff')->comment('Цвет текста кнопок');
            $table->string('main_text_color')->default('#000000')->comment('Цвет текста главного блока');
            $table->string('additional_text_color')->default('#000000')->comment('Цвет текста доп. блоков');
        });
    }
};
