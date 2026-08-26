<?php

namespace App\Models;

use App\Models\Concerns\HasAuditFields;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasAuditFields;

    protected $fillable = [
        'company',
        'position',
        'start_date',
        'end_date',
        'description',
        'order',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
