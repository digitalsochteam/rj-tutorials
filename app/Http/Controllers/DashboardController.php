<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\BlogPost;
use App\Models\Course;
use App\Models\Enquiry;
use App\Models\GalleryImage;
use App\Models\HomeSeo;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\FeesContent;
use App\Models\FeeStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $activePanel = request('panel', session('panel', 'overview'));
        // Only allow known panels
        if (!in_array($activePanel, ['overview', 'about', 'team', 'blog', 'courses', 'gallery', 'enquiries', 'seo', 'testimonials', 'fees'])) {
            $activePanel = 'overview';
        }

        return view('backend.dashboard', [
            'user'         => Auth::user(),
            'about'        => AboutUs::instance(),
            'teamMembers'  => TeamMember::orderBy('sort_order')->get(),
            'blogPosts'    => BlogPost::orderByDesc('created_at')->get(),
            'courses'         => Course::orderBy('sort_order')->get(),
            'galleryImages'   => GalleryImage::orderBy('sort_order')->get(),
            'enquiries'       => Enquiry::orderByDesc('created_at')->get(),
            'unreadCount'     => Enquiry::unread()->count(),
            'homeSeo'         => HomeSeo::instance(),
            'testimonials'    => Testimonial::orderBy('sort_order')->get(),
            'feeStructures'   => FeeStructure::orderBy('sort_order')->get(),
            'feesContent'     => FeesContent::instance(),
            'activePanel'     => $activePanel,
        ]);
    }
}
