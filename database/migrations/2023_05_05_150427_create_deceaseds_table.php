<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deceaseds', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('death_place');
            $table->date('death_date');
            $table->date('burial_date');
            $table->string('washer');
            $table->string('carrier');
            $table->string('region');
            $table->string('tomb');
            $table->string('room');
            $table->longText('notes');
            $table->string('files');
            $table->integer('region_id')->index()->references('id')->on('regions')->onDelete('cascade');
            $table->integer('tomb_id')->index()->references('id')->on('tombs')->onDelete('cascade');
            $table->integer('rooms_id')->index()->references('id')->on('rooms')->onDelete('cascade');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deceaseds');
    }
};
