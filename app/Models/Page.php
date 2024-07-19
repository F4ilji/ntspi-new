<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function section() : BelongsTo
    {
        return $this->belongsTo(SubSection::class, 'sub_section_id');
    }

    protected $casts = [
        'content' => 'array',
    ];

}
