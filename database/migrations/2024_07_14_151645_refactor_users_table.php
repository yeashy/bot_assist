<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
            $table->dropColumn(['email', 'email_verified_at', 'remember_token']);
            $table->string('phone_number');
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('phone_number');
            $table->string('name')->nullable(false)->change();
            $table->string('patronymic')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {


            $table->string('password')->nullable(false)->change();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->dropColumn('phone_number');
            $table->string('email');

            if (!$this->hasUniqueEmailIndex()) {
                $table->string('email')->unique()->change();
            }
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->string('phone_number');
            $table->string('name')->nullable()->change();
            $table->string('patronymic')->nullable(false)->change();
        });
    }

    private function hasUniqueEmailIndex(): bool
    {
        $emailUniqueKeyExists = Schema::getConnection()
            ->getDoctrineSchemaManager()
            ->listTableIndexes('users');

        return array_key_exists('users_email_unique', $emailUniqueKeyExists);
    }
};
