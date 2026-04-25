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
        Schema::table('loans', function (Blueprint $table) {
            $table->after('warranty_id',function(Blueprint $table){
                $table->foreignId('loan_type_id')->constrained('Loan_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                $table->foreignId('loan_status_id')->constrained('loan_statuses')->onDelete('cascade')
                ->onUpdate('cascade');

            });
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            //
        });
    }
};
