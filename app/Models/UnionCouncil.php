<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnionCouncil extends Model
{
    protected $fillable = [
        'name',
        'image',
        'order',
        'members',
    ];

    protected function casts(): array
    {
        return [
            'members' => 'array',
            'order' => 'integer',
        ];
    }

    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('Assets/images/images.jpg');
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
