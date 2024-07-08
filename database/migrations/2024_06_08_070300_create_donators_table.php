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
        Schema::create('new_donators', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('mobile_number');
            $table->string('donator_type');
            $table->string('donator_duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donators');
    }
};
