<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $casts = [
        'is_only_worker' => 'boolean',
        'awards' => 'array',
        'professDisciplines' => 'array',
        'professionalRetraining' => 'array',
        'professionalDevelopment' => 'array',
        'attendedConferences' => 'array',
        'participationScienceProjects' => 'array',
        'publications' => 'array',
        'other' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');

    }

}

