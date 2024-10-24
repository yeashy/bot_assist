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
        Schema::create('fonts', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->comment('Название шрифта');
        });

        Schema::table('company_design_infos', function (Blueprint $table): void {
            $table->dropColumn(['font']);
            $table->foreignIdFor(Font::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_design_infos', function (Blueprint $table): void {
            $table->string('font')->default('Arial');
            $table->dropConstrainedForeignIdFor(Font::class);
        });

        Schema::dropIfExists('fonts');
    }
};
