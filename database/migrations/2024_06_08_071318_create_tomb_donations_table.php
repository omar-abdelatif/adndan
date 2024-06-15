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
        Schema::create('tomb_donations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('mobile_no');
            $table->string('donator_type');
            $table->bigInteger('amount');
            $table->bigInteger('invoice_no');
            $table->string('donator_duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tomb_donations');
    }
};
