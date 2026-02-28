<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSeo extends Model
{
    protected $table = 'home_seo';

    protected $fillable = [
        'seo_title',
        'seo_description',
        'seo_keywords',
        'og_image',
    ];

    /** Always retrieve (or create) the single SEO record. */
    public static function instance(): static
    {
        return static::firstOrCreate([], [
            'seo_title'       => 'RJ TUTORIALS – Expert Coaching for JEE, NEET & MHCET',
            'seo_description' => 'RJ Tutorials provides expert coaching for students in grades VIII–XII across CBSE, ICSE and state boards, with specialised preparation for JEE, NEET and MHCET. Based in Chembur, Mumbai.',
            'seo_keywords'    => 'RJ Tutorials, coaching institute Mumbai, JEE coaching, NEET coaching, MHCET, Chembur tuition, CBSE ICSE coaching',
            'og_image'        => null,
        ]);
    }
}
