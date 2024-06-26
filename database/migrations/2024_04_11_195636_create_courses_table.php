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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->string('name');
            $table->string('description');
            $table->string('picture');
            $table->enum('highlighted', ['true', 'false'])->default('false');
            $table->decimal('price');
            $table->enum('role',['free','paid']);
            $table->enum('validate',['lifetime','one_year']);
            $table->enum('status', ['draft', 'pending', 'rejected', 'approved'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
