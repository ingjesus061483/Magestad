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
        Schema::create('newnesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id') ->constrained('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->dateTime('date');
           /* $table->foreignId('client_id') ->constrained('clients')
            ->onDelete('cascade')
            ->onUpdate('cascade');*/
            $table->string('client',50);
            $table->foreignId('newness_type_id') ->constrained('newness_types')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('remark',255);
            $table->foreignId('state_newness_id') ->constrained('state_newness')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newnesses');
    }
};
