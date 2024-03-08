<?php

use App\Models\CompanyType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_types', function (Blueprint $table) {
            $table->id();
            $table->string('code_name');
            $table->string('name');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->foreignIdFor(CompanyType::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['company_type_id']);
            $table->dropColumn(['company_type_id']);
        });
        Schema::dropIfExists('company_types');
    }
}
