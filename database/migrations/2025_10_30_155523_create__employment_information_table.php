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
        Schema::create('employment_informations', function (Blueprint $table) {
            $table->id();
            $table->string("nit_company_work",50)->nullable();
            $table ->string("company_works",100)->nullable();
            $table->string ("main_address",50)->nullable();
            $table ->string("company_on_mission",50)->nullable();
            $table->string("nit",50)->nullable();
            $table->string("branch_address",50)->nullable();
            $table->date("entry_date");
            $table->decimal("average_monthly_salary",22,2);
            $table->string("current_position");
            $table->foreignId('client_id')
            ->constrained('clients')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId("payment_frequency_id")
                  ->constrained("payment_frequency")
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignId('company_payment_date_id')
                  ->constrained('company_payment_dates')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignId('customer_payment_date_id')
                  ->constrained('customer_payment_dates')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignId('contract_type_id')
                  ->constrained('contract_types')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignId('eps_affiliate_id')
                  ->constrained('eps_affiliates')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignId('arl_affiliate_id')
                ->constrained('arl_affiliates')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_informations');
    }
};
