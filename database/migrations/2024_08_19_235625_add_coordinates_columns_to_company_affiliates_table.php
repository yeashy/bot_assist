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
        Schema::table('company_affiliates', function (Blueprint $table) {
            $table->float('latitude', 16, 8)->after('address')->nullable();
            $table->float('longitude', 16, 8)->after('latitude')->nullable();
            $table->string('phone_number')->after('longitude')->nullable();
            $table->boolean('is_main')->after('phone_number')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_affiliates', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude', 'is_main', 'phone_number']);
        });
    }
};
