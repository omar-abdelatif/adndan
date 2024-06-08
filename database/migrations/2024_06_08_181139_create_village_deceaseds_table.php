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
        Schema::create('village_deceaseds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('death_place');
            $table->date('death_date');
            $table->date('burial_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('village_deceaseds');
    }
};
