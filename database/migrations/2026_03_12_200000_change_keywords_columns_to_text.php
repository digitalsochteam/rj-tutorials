<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // home_seo
        Schema::table('home_seo', function (Blueprint $table) {
            $table->text('seo_title')->nullable()->change();
            $table->text('seo_description')->nullable()->change();
            $table->text('seo_keywords')->nullable()->change();
        });

        // blog_posts
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->text('meta_title')->nullable()->change();
            $table->text('meta_description')->nullable()->change();
            $table->text('meta_keywords')->nullable()->change();
        });

        // courses
        Schema::table('courses', function (Blueprint $table) {
            $table->text('meta_title')->nullable()->change();
            $table->text('meta_description')->nullable()->change();
            $table->text('meta_keywords')->nullable()->change();
        });

        // about_us (added by Mar-12 migration)
        if (Schema::hasColumn('about_us', 'meta_title')) {
            Schema::table('about_us', function (Blueprint $table) {
                $table->text('meta_title')->nullable()->change();
                $table->text('meta_description')->nullable()->change();
                $table->text('meta_keywords')->nullable()->change();
            });
        }

        // page_seo (added by Mar-12 migration)
        if (Schema::hasColumn('page_seo', 'meta_title')) {
            Schema::table('page_seo', function (Blueprint $table) {
                $table->text('meta_title')->nullable()->change();
                $table->text('meta_description')->nullable()->change();
                $table->text('meta_keywords')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        Schema::table('home_seo', function (Blueprint $table) {
            $table->string('seo_title')->nullable()->change();
            $table->string('seo_description', 320)->nullable()->change();
            $table->string('seo_keywords', 500)->nullable()->change();
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->change();
            $table->string('meta_description', 165)->nullable()->change();
            $table->string('meta_keywords')->nullable()->change();
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->change();
            $table->string('meta_description', 165)->nullable()->change();
            $table->string('meta_keywords')->nullable()->change();
        });
    }
};
