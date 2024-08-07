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
        Schema::table('table_case', function (Blueprint $table) {
            $table->bigInteger('another_phone_number')->after('phone_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_case', function (Blueprint $table) {
            $table->dropColumn('another_phone_number');
        });
    }
};
