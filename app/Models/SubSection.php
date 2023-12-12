<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSection extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function mainSection()
    {
        return $this->belongsTo(MainSection::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
