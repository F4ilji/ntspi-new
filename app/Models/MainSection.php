<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSection extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function subSections()
    {
        return $this->hasMany(SubSection::class);
    }

}
