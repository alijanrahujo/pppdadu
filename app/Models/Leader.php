<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $fillable = [
        'name',
        'role',
        'district',
        'image',
        'link',
        'category',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order' => 'integer',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('order')->orderBy('id');
    }

    public function scopeSlider(Builder $query): Builder
    {
        return $query->where('category', 'leadership_slider');
    }

    public function scopeCentral(Builder $query): Builder
    {
        return $query->where('category', 'central_leadership');
    }

    public function scopeDistrictBody(Builder $query): Builder
    {
        return $query->where('category', 'district_body');
    }

    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png');
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
