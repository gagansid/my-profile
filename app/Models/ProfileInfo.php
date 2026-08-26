<?php

namespace App\Models;

use App\Models\Concerns\HasAuditFields;
use Illuminate\Database\Eloquent\Model;

class ProfileInfo extends Model
{
    use HasAuditFields;

    protected $table = 'profile_info';

    protected $fillable = [
        'name',
        'profession',
        'summary',
        'avatar_path',
        'cv_path',
        'years_experience',
        'completed_projects',
        'satisfied_customers',
        'created_by',
        'updated_by',
    ];
}
