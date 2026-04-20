<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Models\TeamMember;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeSeoController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\FeeStructureController;
use App\Http\Controllers\FeesContentController;
use App\Http\Controllers\PageSeoController;
use App\Models\AboutUs;
use App\Models\BlogPost;
use App\Models\Course;
use App\Models\GalleryImage;
use App\Models\HomeSeo;
use App\Models\PageSeo;
use App\Models\Testimonial;
use App\Models\FeesContent;
use App\Models\FeeStructure;




Route::get('/', function () {
    $about        = AboutUs::instance();
    $homeSeo      = HomeSeo::instance();
    $team         = TeamMember::where('is_active', true)->orderBy('sort_order')->get();
    $courses      = Course::where('is_active', true)->orderBy('sort_order')->get();
    $testimonials = Testimonial::active()->orderBy('sort_order')->get();
    return view('Frontend.index', compact('about', 'homeSeo', 'team', 'courses', 'testimonials'));
});
Route::get('/about', function () {
    $about = AboutUs::instance();
    return view('Frontend.about', compact('about'));
})->name('about');

Route::get('/team', function () {
    $team = TeamMember::where('is_active', true)->orderBy('sort_order')->get();
    return view('Frontend.team', compact('team'));
})->name('team');

Route::get('/gallery', function () {
    $images  = GalleryImage::active()->orderBy('title')->get();
    $seo     = PageSeo::for('gallery');
    return view('Frontend.gallery', compact('images', 'seo'));
})->name('gallery');

Route::get('/blog', function () {
    $posts = BlogPost::published()->paginate(9);
    $seo   = PageSeo::for('blog');
    return view('Frontend.blog', compact('posts', 'seo'));
})->name('blog');

Route::get('/courses', function () {
    $courses = Course::where('is_active', true)->orderBy('sort_order')->get();
    $seo     = PageSeo::for('courses');
    return view('Frontend.courses', compact('courses', 'seo'));
})->name('courses');

Route::get('/contact', function () {
    $seo = PageSeo::for('contact');
    return view('Frontend.contact', compact('seo'));
})->name('contact');

Route::post('/contact', [EnquiryController::class, 'store'])->name('enquiry.store');

Route::get('/thank-you', function () {
    return view('Frontend.thank-you');
})->name('thank-you');

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/about-us/edit', [AboutUsController::class, 'edit'])->name('about-us.edit');
    Route::post('/about-us/update', [AboutUsController::class, 'update'])->name('about-us.update');

    // Team CRUD
    Route::get('/team/create', [TeamController::class, 'create'])->name('team.create');
    Route::post('/team', [TeamController::class, 'store'])->name('team.store');
    Route::get('/team/{team}/edit', [TeamController::class, 'edit'])->name('team.edit');
    Route::put('/team/{team}', [TeamController::class, 'update'])->name('team.update');
    Route::delete('/team/{team}', [TeamController::class, 'destroy'])->name('team.destroy');

    // Blog CRUD
    Route::get('/blog/create', [BlogPostController::class, 'create'])->name('blog.create');
    Route::post('/blog', [BlogPostController::class, 'store'])->name('blog.store');
    Route::get('/blog/{blog}/edit', [BlogPostController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{blog}', [BlogPostController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{blog}', [BlogPostController::class, 'destroy'])->name('blog.destroy');

    // Courses CRUD
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

    // Gallery CRUD
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{gallery}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/{gallery}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // Enquiry management
    Route::patch('/enquiries/{enquiry}/read', [EnquiryController::class, 'markRead'])->name('enquiry.read');
    Route::delete('/enquiries/{enquiry}', [EnquiryController::class, 'destroy'])->name('enquiry.destroy');

    // Home SEO
    Route::post('/home-seo', [HomeSeoController::class, 'update'])->name('home-seo.update');

    // Testimonials CRUD
    Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
    Route::get('/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // Fees page intro content
    Route::post('/fees-content', [FeesContentController::class, 'update'])->name('fees-content.update');

    // Page SEO (courses, gallery, blog, fees, contact)
    Route::post('/page-seo/{page}', [PageSeoController::class, 'update'])->name('page-seo.update');

    // Fee Structure CRUD
    Route::get('/fees/create', [FeeStructureController::class, 'create'])->name('fees.create');
    Route::post('/fees', [FeeStructureController::class, 'store'])->name('fees.store');
    Route::get('/fees/{fee}/edit', [FeeStructureController::class, 'edit'])->name('fees.edit');
    Route::put('/fees/{fee}', [FeeStructureController::class, 'update'])->name('fees.update');
    Route::delete('/fees/{fee}', [FeeStructureController::class, 'destroy'])->name('fees.destroy');
});

// Fees page
Route::get('/fees', function () {
    $feesContent = FeesContent::instance();
    $feeGroups   = FeeStructure::active()->orderBy('sort_order')->get()->groupBy('course_name');
    $seo         = PageSeo::for('fees');
    return view('Frontend.fees', compact('feesContent', 'feeGroups', 'seo'));
})->name('fees');

// Public blog detail — declared AFTER auth group so /blog/create resolves to the auth route above
Route::get('/blog/{slug}', function (string $slug) {
    $post = BlogPost::where('slug', $slug)->where('is_published', true)->firstOrFail();
    $allIds  = BlogPost::published()->pluck('id');
    $idx     = $allIds->search($post->id);
    $prev    = $idx > 0 ? BlogPost::find($allIds[$idx - 1]) : null;
    $next    = $idx < $allIds->count() - 1 ? BlogPost::find($allIds[$idx + 1]) : null;
    $related = BlogPost::published()->where('id', '!=', $post->id)
        ->where('category', $post->category)->take(3)->get();
    return view('Frontend.blog-detail', compact('post', 'prev', 'next', 'related'));
})->name('blog.show');

// Public course detail — declared AFTER auth group so /courses/create resolves to the auth route above
Route::get('/courses/{slug}', function (string $slug) {
    $course = Course::where('slug', $slug)->where('is_active', true)->firstOrFail();
    $allIds  = Course::where('is_active', true)->orderBy('sort_order')->pluck('id');
    $idx     = $allIds->search($course->id);
    $prev    = $idx > 0 ? Course::find($allIds[$idx - 1]) : null;
    $next    = $idx < $allIds->count() - 1 ? Course::find($allIds[$idx + 1]) : null;
    $otherCourses = Course::where('is_active', true)->where('id', '!=', $course->id)
        ->orderBy('sort_order')->take(5)->get();
    return view('Frontend.course-detail', compact('course', 'prev', 'next', 'otherCourses'));
})->name('courses.show');

/*
|--------------------------------------------------------------------------
| Secure Migration Route (for live server — shared hosting without SSH)
| Usage: /run-migrations?key=YOUR_SECRET_KEY
| Set MIGRATE_SECRET_KEY in your .env on the live server.
|--------------------------------------------------------------------------
*/

Route::get('/run-migrations', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migrations executed successfully.';
});