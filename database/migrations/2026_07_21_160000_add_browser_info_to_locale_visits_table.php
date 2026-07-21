<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('locale_visits', function (Blueprint $table) {
            $table->string('user_agent', 500)->nullable()->after('locale');
            $table->string('browser')->nullable()->after('user_agent');
            $table->string('os')->nullable()->after('browser');
            $table->string('device_type')->nullable()->after('os');
            $table->string('ip_address', 45)->nullable()->after('device_type');
        });
    }

    public function down(): void
    {
        Schema::table('locale_visits', function (Blueprint $table) {
            $table->dropColumn(['user_agent', 'browser', 'os', 'device_type', 'ip_address']);
        });
    }
};
