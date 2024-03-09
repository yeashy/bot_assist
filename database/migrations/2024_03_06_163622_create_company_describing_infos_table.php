<?php

use App\Models\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDescribingInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_describing_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('main_link')->nullable()->comment('Основная ссылка на сайт компании');
            $table->string('phone_number')->nullable()->comment('Рабочий телефон компании (поддержка)');
            $table->string('logo_path')->nullable()->comment('Путь к логотипу компании');
            $table->string('address')->nullable()->comment('Адрес главного офиса компании');
            $table->string('email')->nullable()->comment('Рабочая почта компании (поддержка)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_describing_infos');
    }
}
