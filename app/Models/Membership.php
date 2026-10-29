<?php

namespace App\Models;

use Database\Factories\MembershipFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    /** @use HasFactory<MembershipFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'volunteering' => 'array',
            'is_read' => 'boolean',
        ];
    }

    public function getFullNameAttribute(): string
    {
        return trim(($this->first_name ?? '').' '.($this->last_name ?? ''));
    }

    /**
     * Provide a compatible payload array for views.
     *
     * @return array<string, mixed>
     */
    public function getPayloadAttribute(): array
    {
        return [
            'full_name' => $this->full_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email_address' => $this->email_address,
            'mobile_number' => $this->mobile_number,
            'phone_number' => $this->mobile_number,
            'cnic_number' => $this->cnic_number,
            'date_of_birth' => $this->date_of_birth ? $this->date_of_birth->format('Y-m-d') : null,
            'education' => $this->education,
            'profession' => $this->profession,
            'resident_type' => $this->resident_type ?? 'Pakistani',
            'province' => $this->province ?? 'Sindh',
            'division' => $this->division ?? 'Hyderabad',
            'district' => $this->district ?? 'Dadu',
            'tehsil_city' => $this->tehsil_city,
            'city' => $this->tehsil_city,
            'address' => $this->current_address,
            'current_address' => $this->current_address,
            'permanent_address' => $this->permanent_address,
            'member_type' => $this->member_type,
            'gender' => $this->gender,
            'profile_picture' => $this->profile_picture,
            'volunteering' => $this->volunteering ?? [],
            'facebook_url' => $this->facebook_url,
            'twitter_url' => $this->twitter_url,
            'instagram_url' => $this->instagram_url,
            'tiktok_url' => $this->tiktok_url,
        ];
    }
}
