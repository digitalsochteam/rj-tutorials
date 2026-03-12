<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSeo extends Model
{
    protected $table = 'page_seo';

    protected $fillable = [
        'page',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    /** Always retrieve (or create) the SEO record for a given page. */
    public static function for(string $page): static
    {
        return static::firstOrCreate(['page' => $page]);
    }
}
