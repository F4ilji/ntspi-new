<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Event extends Model
{
    use HasFactory, HasTags;

    protected $guarded = false;

    protected $casts = [
        'content' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(EventCategory::class);
    }
}
