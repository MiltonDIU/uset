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
        Schema::create('tuitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tuition_type_id')->constrained()->cascadeOnDelete();
            $table->decimal('min_credit', 12, 2)->nullable();
            $table->decimal('max_credit', 12, 2)->nullable();
            $table->decimal('min_total_cost', 12, 2)->nullable();
            $table->decimal('max_total_cost', 12, 2)->nullable();
            $table->decimal('min_tuition_fee', 12, 2)->nullable();
            $table->decimal('max_tuition_fee', 12, 2)->nullable();
            $table->decimal('admission_fee', 12, 2)->nullable();
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
        Schema::dropIfExists('tuitions');
    }
};
