<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $casts = [
        'days' => 'array',
    ];

    public function subSchedules()
    {
        return $this->hasMany(SubSchedule::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }


}
