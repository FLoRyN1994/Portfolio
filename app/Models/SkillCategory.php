<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillCategory extends Model
{
    protected $fillable = ['name', 'description', 'items', 'col_span', 'variant', 'sort_order'];

    protected $casts = [
        'items'    => 'array',
        'col_span' => 'integer',
    ];
}
