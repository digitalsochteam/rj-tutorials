<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeesContent extends Model
{
    protected $table = 'fees_page_contents';

    protected $fillable = ['intro_content'];

    /** Always retrieve (or create) the single fees page content record. */
    public static function instance(): static
    {
        return static::firstOrCreate([], [
            'intro_content' => null,
        ]);
    }
}
