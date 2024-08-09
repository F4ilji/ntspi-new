<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function workers()
    {
        return $this->belongsToMany(User::class, 'workers_departments')->withPivot(['position']);
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'teachers_departments')->withPivot(['teaching_position']);
    }
}
