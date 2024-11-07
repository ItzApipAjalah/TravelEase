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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ticket_no');
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('officer_id')->nullable();
            $table->timestamp('scheduled_at')->nullable();
            $table->enum('status', ['pending', 'closed', 'canceled'])->default('pending');
            $table->enum('priority', ['low', 'medium', 'high'])->default('low');
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('officer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
