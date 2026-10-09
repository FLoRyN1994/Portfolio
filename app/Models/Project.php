<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'summary', 'content', 'url', 'github_url',
        'thumbnail', 'tech_stack', 'featured', 'sort_order',
        'role', 'agency_id', 'published',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'featured'   => 'boolean',
        'published'  => 'boolean',
    ];

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true)->orderBy('sort_order');
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}
