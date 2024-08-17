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
        Schema::table('company_design_infos', function (Blueprint $table) {
            $table->string('background_color')->default('#ffffff')->change();
            $table->string('block_background_color')->default('#ffffff')->change();
            $table->string('main_background_color')->default('#ffffff')->change();
            $table->string('additional_background_color')->default('#ffffff')->change();
            $table->string('button_text_color')->default('#ffffff')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_design_infos', function (Blueprint $table) {
            $table->string('background_color')->default('#FFFFFF')->change();
            $table->string('block_background_color')->default('#FFFFFF')->change();
            $table->string('main_background_color')->default('#FFFFFF')->change();
            $table->string('additional_background_color')->default('#FFFFFF')->change();
            $table->string('button_text_color')->default('#FFFFFF')->change();
        });
    }
};
