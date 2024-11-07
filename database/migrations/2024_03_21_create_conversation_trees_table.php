<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('conversation_trees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('conversation_trees')->nullOnDelete();
            $table->string('question');
            $table->text('answer')->nullable();
            $table->string('button_text');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conversation_trees');
    }
};
