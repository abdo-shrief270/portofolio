<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title');
            $table->string('provider');
            $table->string('instructor')->nullable();
            $table->text('description')->nullable();
            $table->string('certificate_url')->nullable();
            $table->string('course_url')->nullable();
            $table->date('completed_at')->nullable();
            $table->integer('duration_hours')->nullable();
            $table->json('skills_learned')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
