<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalProgram extends Model
{
    use HasFactory;

    protected $guarded = false;


    protected $casts = [
        'learning_forms' => 'array',
    ];

    public function directionStudy()
    {
        return $this->belongsTo(DirectionStudy::class);
    }

    public function contests()
    {
        return $this->hasMany(ProgramContest::class);
    }

    public function exams()
    {
        return $this->hasMany(ProgramExam::class);
    }
}
