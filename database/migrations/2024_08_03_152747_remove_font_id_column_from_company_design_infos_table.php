<?php

use App\Models\Font;
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
            $table->dropForeignIdFor(Font::class);
            $table->dropColumn('font_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_design_infos', function (Blueprint $table) {
            $table->foreignIdFor(Font::class)
                ->default(Font::query()->first()->id)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }
};
