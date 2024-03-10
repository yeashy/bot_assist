<?php

use App\Models\Gender;
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
        Schema::create('genders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название пола');
        });

        Schema::table('client_describing_infos', function (Blueprint $table) {
            $table->foreignIdFor(Gender::class)->nullable()->after('client_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });

        Schema::table('staff_member_describing_infos', function (Blueprint $table) {
            $table->foreignIdFor(Gender::class)->nullable()->after('staff_member_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_describing_infos', function (Blueprint $table) {
            $table->dropForeignIdFor(Gender::class);
        });

        Schema::table('staff_member_describing_infos', function (Blueprint $table) {
            $table->dropForeignIdFor(Gender::class);
        });

        Schema::dropIfExists('genders');
    }
};
