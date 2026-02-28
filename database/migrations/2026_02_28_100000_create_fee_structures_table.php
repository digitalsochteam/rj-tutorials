<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();
            $table->string('category');           // e.g. "SSC", "HSC Science", "HSC Commerce"
            $table->string('class_name');          // e.g. "8th Standard", "11th & 12th Science"
            $table->string('subjects')->nullable(); // e.g. "Maths, Science"
            $table->decimal('monthly_fee', 10, 2)->nullable();
            $table->decimal('quarterly_fee', 10, 2)->nullable();
            $table->decimal('annual_fee', 10, 2)->nullable();
            $table->string('note')->nullable();    // e.g. "Inclusive of all subjects"
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_structures');
    }
};
