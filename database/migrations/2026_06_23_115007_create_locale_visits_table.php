<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('locale_visits', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locale_visits');
    }
};