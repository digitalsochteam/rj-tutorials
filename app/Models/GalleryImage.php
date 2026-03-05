<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = [
        'title',
        'category',
        'media_type',
        'image',
        'video_url',
        'video_file',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function isVideo(): bool
    {
        return $this->media_type === 'video';
    }

    public function isLocalVideo(): bool
    {
        return $this->media_type === 'video' && !empty($this->video_file);
    }

    /** Extract YouTube video ID from various URL formats. */
    public function getYoutubeIdAttribute(): ?string
    {
        if (!$this->video_url) return null;
        if (preg_match('/youtube\.com\/watch\?v=([^&\s]+)/', $this->video_url, $m)) return $m[1];
        if (preg_match('/youtu\.be\/([^?&\s]+)/', $this->video_url, $m)) return $m[1];
        if (preg_match('/youtube\.com\/embed\/([^?&\s]+)/', $this->video_url, $m)) return $m[1];
        return null;
    }

    /** Return a safe iframe-ready embed URL (YouTube/Vimeo only). */
    public function getEmbedUrlAttribute(): ?string
    {
        if (!$this->video_url) return null;

        if ($ytId = $this->youtube_id) {
            return 'https://www.youtube.com/embed/' . $ytId . '?rel=0&autoplay=1';
        }

        if (preg_match('/vimeo\.com\/(\d+)/', $this->video_url, $m)) {
            return 'https://player.vimeo.com/video/' . $m[1] . '?autoplay=1';
        }

        return $this->video_url;
    }

    /** Public URL for locally uploaded video file. */
    public function getVideoSrcAttribute(): ?string
    {
        if (!$this->video_file) return null;
        return asset('storage/' . $this->video_file);
    }

    /** Best thumbnail URL for display. */
    public function getThumbnailAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        if ($ytId = $this->youtube_id) {
            return "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg";
        }
        return asset('assets/images/video-placeholder.svg');
    }
}
