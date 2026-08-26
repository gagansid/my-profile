<?php

namespace App\Models;

use App\Models\Concerns\HasAuditFields;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    use HasAuditFields;

    protected $fillable = [
        'platform',
        'url',
        'icon',
        'order',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
