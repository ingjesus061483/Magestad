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
        Schema::table('employment_informations', function (Blueprint $table) {
            $table->after('arl_affiliate_id',function(Blueprint $table){
                $table->foreignId('occupational_position_id')
                ->constrained('occupational_positions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            });
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employment_informations', function (Blueprint $table) {
            //
        });
    }
};
