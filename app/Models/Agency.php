<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = ['name', 'url', 'logo_path', 'sort_order'];
}
