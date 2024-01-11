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
        Schema::table('donation_histories', function (Blueprint $table) {
            $table->string('donation_type')->after('duration');
            $table->string('other_type')->after('donation_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donation_histories', function (Blueprint $table) {
            $table->dropColumn('donation_type');
            $table->dropColumn('other_type');
        });
    }
};
