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
        Schema::table('tomb_donations', function (Blueprint $table) {
            $table->bigInteger('new_tomb_donators_id')->after('donation_duration')->index()->references("id")->on("new_donators")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tomb_donations', function (Blueprint $table) {
            $table->dropColumn('tomb_donator_id');
        });
    }
};
