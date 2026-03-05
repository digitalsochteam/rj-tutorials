<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->string('media_type')->default('image')->after('id');
            $table->string('video_url', 500)->nullable()->after('image');
            $table->string('image')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->dropColumn(['media_type', 'video_url']);
            $table->string('image')->nullable(false)->change();
        });
    }
};
