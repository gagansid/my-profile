<?php

namespace App\Models;

use App\Models\Concerns\HasAuditFields;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasAuditFields;

    protected $fillable = [
        'name',
        'category',
        'icon',
        'order',
        'created_by',
        'updated_by',
    ];
}
