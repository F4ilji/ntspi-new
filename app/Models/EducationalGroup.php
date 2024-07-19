<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalGroup extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
