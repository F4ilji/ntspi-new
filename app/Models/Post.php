<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Tags\HasTags;

class Post extends Model
{
    use HasFactory, HasTags;

    protected $guarded = false;

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected $casts = [
        'content' => 'array',
        'authors' => 'array',
        'status' => PostStatus::class,
        'images' => 'array'
    ];
}
