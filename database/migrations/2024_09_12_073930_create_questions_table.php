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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question_text'); // Required text
            $table->string('question_image'); // Required image path
            $table->string('option_a')->nullable(); // Option A text or image path
            $table->string('option_b')->nullable(); // Option B text or image path
            $table->string('option_c')->nullable(); // Option C text or image path
            $table->string('option_d')->nullable(); // Option D text or image path
            $table->string('option_e')->nullable(); // Option D text or image path
            $table->string('option_f')->nullable(); // Option D text or image path
            $table->string('ans'); // Correct answer (option_a, option_b, option_c, option_d)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
