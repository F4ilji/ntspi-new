<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function authors()
    {
        return $this->hasMany(AuthorPost::class, 'post_id', 'id');
    }

    public function gallery() {
        return $this->hasOne(Gallery::class);
    }

}
