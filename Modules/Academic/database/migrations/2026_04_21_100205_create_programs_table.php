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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->foreignId('program_type_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('sub_title')->nullable();
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('overview')->nullable();
            $table->longText('description')->nullable();
            $table->string('duration')->nullable();
            $table->integer('total_semester')->nullable();
            $table->string('semester_duration')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
