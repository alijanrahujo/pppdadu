<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = [
        'title',
        'alt',
        'category',
        'image',
        'is_featured_home',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'is_featured_home' => 'boolean',
            'order' => 'integer',
        ];
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured_home', true)->orderBy('order')->orderBy('id');
    }

    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('Assets/images/images-8.jpg');
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
}
