<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function section()
    {
        return $this->belongsTo(SubSection::class, 'sub_section_id');
    }

}
