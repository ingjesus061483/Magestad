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
        Schema::table('clients', function (Blueprint $table) {
            $table->after('estate',function (Blueprint $table){
                $table->foreignId('quality_holder_id')
                      ->constrained('quality_holders')
                     ->onUpdate('cascade')
                     ->onDelete('cascade');
                $table->foreignId('marital_status_id')
                      ->constrained('marital_status')
                      ->onUpdate('cascade')
                      ->onDelete('cascade');
                $table->foreignId('level_study_id')
                      ->constrained('level_studies')   //
                      ->onUpdate('cascade')
                      ->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            //
        });
    }
};
