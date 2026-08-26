<?php

namespace App\Models;

use App\Models\Concerns\HasAuditFields;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasAuditFields;

    protected $fillable = [
        'is_site_public',
        'maintenance_message',
        'show_about',
        'show_projects',
        'show_blog',
        'show_contact',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_site_public' => 'boolean',
        'show_about' => 'boolean',
        'show_projects' => 'boolean',
        'show_blog' => 'boolean',
        'show_contact' => 'boolean',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate(['id' => 1], [
            'is_site_public' => true,
            'show_about' => true,
            'show_projects' => true,
            'show_blog' => true,
            'show_contact' => true,
        ]);
    }
}
