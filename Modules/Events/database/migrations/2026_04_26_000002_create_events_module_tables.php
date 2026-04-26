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
        Schema::create('event_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id')->nullable()->constrained('faculties')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('event_category_id')->nullable()->constrained('event_categories')->nullOnDelete();
            
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            
            $table->date('event_date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            
            $table->string('venue')->nullable();
            $table->string('organizer')->nullable();
            $table->string('contact_person')->nullable();
            
            $table->string('status')->default('Upcoming'); // Upcoming, Running, Completed, Cancelled
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_categories');
    }
};
