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
        Schema::create('projects', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();
            $table->longText('description'); // Markdown
            $table->text('short_description');
            $table->foreignUlid('category_id')->constrained('categories')->onDelete('cascade');
            $table->enum('status', ['live', 'in_progress', 'completed', 'archived'])->default('in_progress');
            $table->boolean('is_featured')->default(false);
            $table->string('demo_url')->nullable();
            $table->string('subdomain')->nullable();
            $table->enum('subdomain_status', ['pending', 'provisioning', 'active', 'failed', 'deprovisioned'])->default('pending');
            $table->string('github_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('gallery')->nullable();
            $table->json('tech_stack')->nullable();
            $table->json('features')->nullable(); // Array of {title, description, icon}
            $table->text('temp_credentials')->nullable(); // Will be encrypted in model
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->json('seo_keywords')->nullable();
            $table->string('og_image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
