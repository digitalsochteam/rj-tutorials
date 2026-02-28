<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('tagline')->default('About Us');
            $table->string('title')->default('where education transcends boundaries and transforms lives');
            $table->text('paragraph_1')->nullable();
            $table->text('paragraph_2')->nullable();
            $table->text('paragraph_3')->nullable();
            $table->string('main_image')->nullable();       // about-one-img-1.jpg
            $table->string('secondary_image')->nullable();  // about-one-img-2.jpg
            $table->unsignedInteger('years_experience')->default(25);
            $table->unsignedInteger('students_count')->default(120);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
