<?php

use App\Models\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateCompanyDesignInfosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('company_design_infos', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Company::class)->unique()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('primary_color')->default('#FFFFFF')->comment('Основной цвет компании');
            $table->string('secondary_color')->default('#000000')->comment('Побочный цвет компании');
            $table->string('font')->default('Arial');
            $table->string('font_color')->default('#000000')->comment('Цвет текста компании');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_design_infos');
    }
}
