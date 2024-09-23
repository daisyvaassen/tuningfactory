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
        Schema::create('tunes', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->boolean('visible')->default(true);
            $table->integer('original_hp')->nullable();
            $table->integer('original_nm')->nullable();
            $table->integer('tuned_hp')->nullable();
            $table->integer('tuned_nm')->nullable();
            $table->string('ecu')->nullable();
            $table->string('ecu_category')->nullable();
            $table->integer('cylinder_capacity')->nullable();
            $table->string('compression_ratio')->nullable();
            $table->string('bore_x_stroke')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('engine_ecu')->nullable();
            $table->string('gearbox')->nullable();
            $table->string('read_methods')->nullable();
            $table->json('additional_options')->nullable();
            $table->integer('sort')->default(0);

            $table->foreignUuid('engine_id')->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tunes');
    }
};
