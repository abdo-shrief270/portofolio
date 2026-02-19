<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('company');
            $table->string('position');
            $table->string('location')->nullable();
            $table->enum('type', ['full_time', 'part_time', 'freelance', 'contract', 'internship'])->default('full_time');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->text('description')->nullable();
            $table->json('responsibilities')->nullable();
            $table->json('technologies_used')->nullable();
            $table->string('company_url')->nullable();
            $table->string('company_logo')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
