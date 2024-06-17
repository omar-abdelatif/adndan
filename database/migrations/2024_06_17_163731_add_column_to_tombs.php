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
        Schema::table('tombs', function (Blueprint $table) {
            $table->integer('other_tomb_power')->after('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tombs', function (Blueprint $table) {
            $table->dropColumn('other_tomb_power');
        });
    }
};
