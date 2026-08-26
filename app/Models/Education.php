<?php

namespace App\Models;

use App\Models\Concerns\HasAuditFields;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasAuditFields;

    protected $table = 'educations';

    protected $fillable = [
        'institution',
        'degree',
        'score',
        'start_date',
        'end_date',
        'order',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
