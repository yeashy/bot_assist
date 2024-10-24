<?php

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
        Schema::table('company_design_infos', function (Blueprint $table): void {
            $table->dropColumn(['primary_color', 'secondary_color', 'font_color']);

            $table->string('background_color')->default('#FFFFFF')->comment('Цвет основного фона');
            $table->string('text_color')->default('#000000')->comment('Цвет основного шрифта');
            $table->string('border_color')->default('#000000')->comment('Цвет основных границ');

            $table->string('block_background_color')->default('#FFFFFF')->comment('Цвет основных блоков');
            $table->string('button_background_color')->default('#000000')->comment('Цвет кнопок');
            $table->string('main_background_color')->default('#FFFFFF')->comment('Цвет главного блока');
            $table->string('additional_background_color')->default('#FFFFFF')->comment('Цвет доп. блоков');

            $table->string('button_text_color')->default('#FFFFFF')->comment('Цвет текста кнопок');
            $table->string('main_text_color')->default('#000000')->comment('Цвет текста главного блока');
            $table->string('additional_text_color')->default('#000000')->comment('Цвет текста доп. блоков');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_design_infos', function (Blueprint $table): void {
            $table->dropColumn([
                'background_color',
                'text_color',
                'border_color',
                'block_background_color',
                'button_background_color',
                'main_background_color',
                'additional_background_color',
                'button_text_color',
                'main_text_color',
                'additional_text_color',
            ]);

            $table->string('primary_color')->default('#FFFFFF')->comment('Основной цвет компании');
            $table->string('secondary_color')->default('#000000')->comment('Побочный цвет компании');
            $table->string('font_color')->default('#000000')->comment('Цвет текста компании');
        });
    }
};
