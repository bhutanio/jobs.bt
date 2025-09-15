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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->longText('description');
            $table->longText('requirements');
            $table->string('location')->nullable();
            $table->enum('employment_type', ['full_time','part_time','contract','intern','temp']);
            $table->string('salary')->nullable();
            $table->enum('status', ['draft','published','paused','closed'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->index(['status', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
