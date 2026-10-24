<?php

namespace App\Models;

use Database\Factories\BlogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /** @use HasFactory<BlogFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'image',
        'video',
        'video_url',
        'photos',
        'author_name',
        'author_role',
        'author_avatar',
        'read_time',
        'is_featured',
        'is_published',
        'published_at',
        'views_count',
        'tags',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
            'views_count' => 'integer',
            'tags' => 'array',
            'photos' => 'array',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderByDesc('published_at')->orderByDesc('id');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_published', true)->where('is_featured', true);
    }

    public function scopeCategory($query, ?string $category)
    {
        if ($category && $category !== 'all') {
            return $query->where('category', $category);
        }

        return $query;
    }

    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('Assets/images/Mass-Rally-Beneath-a-Crescent-Flag.jpg');
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        if (file_exists(public_path('storage/'.$this->image))) {
            return asset('storage/'.$this->image);
        }

        if (file_exists(public_path('Assets/images/'.$this->image))) {
            return asset('Assets/images/'.$this->image);
        }

        return asset($this->image);
    }

    public function getVideoFileUrlAttribute(): ?string
    {
        if (empty($this->video)) {
            return null;
        }

        if (str_starts_with($this->video, 'http://') || str_starts_with($this->video, 'https://')) {
            return $this->video;
        }

        if (file_exists(public_path('storage/'.$this->video))) {
            return asset('storage/'.$this->video);
        }

        return asset($this->video);
    }

    public function getEmbedVideoUrlAttribute(): ?string
    {
        if (empty($this->video_url)) {
            return null;
        }

        $url = trim($this->video_url);

        // Convert standard YouTube watch URL to embed
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $url, $matches)) {
            return 'https://www.youtube.com/embed/'.$matches[1];
        }

        // Convert Vimeo URL to embed
        if (preg_match('/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/(?:[^\/]*)\/videos\/|album\/(?:\d+)\/video\/|video\/|)(\d+)/', $url, $matches)) {
            return 'https://player.vimeo.com/video/'.$matches[1];
        }

        return $url;
    }

    public function getHasVideoAttribute(): bool
    {
        return ! empty($this->video) || ! empty($this->video_url);
    }

    public function getPhotosListAttribute(): array
    {
        if (empty($this->photos) || ! is_array($this->photos)) {
            return [];
        }

        $list = [];
        foreach ($this->photos as $photo) {
            if (empty($photo)) {
                continue;
            }
            if (str_starts_with($photo, 'http://') || str_starts_with($photo, 'https://')) {
                $list[] = $photo;
            } elseif (file_exists(public_path('storage/'.$photo))) {
                $list[] = asset('storage/'.$photo);
            } elseif (file_exists(public_path('Assets/images/'.$photo))) {
                $list[] = asset('Assets/images/'.$photo);
            } else {
                $list[] = asset($photo);
            }
        }

        return $list;
    }
}
