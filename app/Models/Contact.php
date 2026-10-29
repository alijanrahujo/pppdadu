<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    /**
     * Compatibility accessor for views expecting payload array.
     *
     * @return array<string, mixed>
     */
    public function getPayloadAttribute(): array
    {
        return [
            'full_name' => $this->full_name,
            'cnic_number' => $this->cnic_number,
            'email_address' => $this->email_address,
            'phone_number' => $this->phone_number,
            'contact_type' => $this->contact_type,
            'message' => $this->message,
        ];
    }
}
