<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table_case', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name');
            $table->integer('ssn')->unique();
            $table->integer('phone_no')->unique();
            $table->integer('age');
            $table->string('address');
            $table->string('income_type');
            $table->string('benefit_type');
            $table->string('marital_status');
            $table->string('health_status');
            $table->string('monthly_income');
            $table->string('sons');
            $table->string('daughters');
            $table->string('gov');
            $table->string('imgs');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_case');
    }
};
