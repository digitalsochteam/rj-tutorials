<?php

namespace App\Providers;

use App\Models\Course;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Share active courses with header & footer on every page
        View::composer(
            [
                'Frontend.layout.header',
                'Frontend.layout.footer',
            ],
            function ($view) {
                $view->with('navCourses', Course::where('is_active', true)->orderBy('sort_order')->get());
            }
        );
    }
}
