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
        Schema::table('engines', function (Blueprint $table) {
            $table->dropColumn('original_hp');
            $table->dropColumn('original_nm');
            $table->dropColumn('tuned_hp');
            $table->dropColumn('tuned_nm');
            $table->dropColumn('ecu');
            $table->dropColumn('ecu_category');
            $table->dropColumn('cylinder_capacity');
            $table->dropColumn('compression_ratio');
            $table->dropColumn('bore_x_stroke');
            $table->dropColumn('engine_number');
            $table->dropColumn('engine_ecu');
            $table->dropColumn('gearbox');
            $table->dropColumn('read_methods');
            $table->dropColumn('additional_options');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('engines', function (Blueprint $table) {
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
        });
    }
};
