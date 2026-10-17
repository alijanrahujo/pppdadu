<?php

namespace App\Models;

use Database\Factories\WebsiteSubmissionFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['submission_type', 'status', 'is_read', 'payload'])]
class WebsiteSubmission extends Model
{
    /** @use HasFactory<WebsiteSubmissionFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'payload' => 'encrypted:array',
            'is_read' => 'boolean',
        ];
    }
}
