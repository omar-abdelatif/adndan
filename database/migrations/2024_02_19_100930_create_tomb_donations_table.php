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
            $table->bigInteger('member_id')->index()->references('member_id')->on('')->onDelete('cascade');
            $table->bigInteger('amount');
            $table->bigInteger('invoice_no');
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
