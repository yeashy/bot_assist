<?php

use App\Models\CompanyType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateCompanyTypesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('company_types', function (Blueprint $table): void {
            $table->id();
            $table->string('code_name')->comment('Кодовое имя (англ, без пробелов и спец. символов)');
            $table->string('name')->comment('Название типа компании');
        });

        Schema::table('companies', function (Blueprint $table): void {
            $table->foreignIdFor(CompanyType::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table): void {
            $table->dropForeign(['company_type_id']);
            $table->dropColumn(['company_type_id']);
        });
        Schema::dropIfExists('company_types');
    }
}
