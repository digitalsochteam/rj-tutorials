<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';

    protected $fillable = [
        'tagline',
        'title',
        'paragraph_1',
        'paragraph_2',
        'paragraph_3',
        'main_image',
        'secondary_image',
        'years_experience',
        'students_count',
    ];

    /**
     * Always retrieve (or create) the single About Us record.
     */
    public static function instance(): static
    {
        return static::firstOrCreate([], [
            'tagline'          => 'About Us',
            'title'            => 'where education transcends boundaries and transforms lives',
            'paragraph_1'      => 'At RJ Tutorials, Education is not just a journey to academic excellence but a transformative experience that shapes both mind and character of every student.',
            'paragraph_2'      => 'Our team of highly qualified and seasoned educator ensure the provision of top-notch education, while concurrently nurturing the values essential for personal and professional growth. At our coaching institute catering to students from grades VIII to XII, spanning CBSE, ICSE, and state boards.',
            'paragraph_3'      => 'Specializing in science streams for grades XI and XII, we offer targeted coaching for JEE / NEET & MHCET exams. Our commitment to excellence extends beyond the classroom, as we cultivate resilient, adaptable individuals equipped to thrive in an ever-evolving world. Join us on this exhilarating journey of discovery, where every lesson is a step towards unlocking the boundless potential within.',
            'main_image'       => null,
            'secondary_image'  => null,
            'years_experience' => 25,
            'students_count'   => 120,
        ]);
    }
}
