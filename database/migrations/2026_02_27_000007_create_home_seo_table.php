<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_seo', function (Blueprint $table) {
            $table->id();
            $table->string('seo_title')->nullable();
            $table->string('seo_description', 320)->nullable();
            $table->string('seo_keywords', 500)->nullable();
            $table->string('og_image')->nullable();   // stored path
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_seo');
    }
};
