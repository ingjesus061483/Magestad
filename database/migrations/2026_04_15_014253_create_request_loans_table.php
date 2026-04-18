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
        Schema::create('request_loans', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('clientName');
            $table->decimal('amountRequested', 10, 2);
            $table->foreignId('priority_id')
                  ->constrained('priorities')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->text('comments')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_loans');
    }
};
