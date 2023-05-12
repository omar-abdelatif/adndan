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
        Schema::table('old_deceaseds', function (Blueprint $table) {
            $table->dateTime('death_date')->after('burial_place');
            $table->string('region')->after('death_date');
            $table->string('tomb')->after('region');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('old_deceaseds', function (Blueprint $table) {
            $table->dropColumn('death_date');
            $table->dropColumn('region');
            $table->dropColumn('tomb');
        });
    }
};
