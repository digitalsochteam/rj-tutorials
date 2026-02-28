<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fee_structures', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn([
                'category', 'class_name', 'subjects',
                'monthly_fee', 'quarterly_fee', 'annual_fee', 'note',
            ]);

            // Add new columns
            $table->string('course_name')->after('id');
            $table->string('type')->after('course_name');          // e.g. Individual / Combo
            $table->decimal('fees', 10, 2)->nullable()->after('type');
            $table->decimal('discount', 10, 2)->nullable()->after('fees');
            $table->decimal('after_discount', 10, 2)->nullable()->after('discount');
        });
    }

    public function down(): void
    {
        Schema::table('fee_structures', function (Blueprint $table) {
            $table->dropColumn(['course_name', 'type', 'fees', 'discount', 'after_discount']);
            $table->string('category')->nullable();
            $table->string('class_name')->nullable();
            $table->string('subjects')->nullable();
            $table->decimal('monthly_fee', 10, 2)->nullable();
            $table->decimal('quarterly_fee', 10, 2)->nullable();
            $table->decimal('annual_fee', 10, 2)->nullable();
            $table->string('note')->nullable();
        });
    }
};
