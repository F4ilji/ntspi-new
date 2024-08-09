<?php

namespace App\Models;

use App\Enums\LevelEducational;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalProgram extends Model
{
    use HasFactory;

    protected $guarded = false;


    protected $casts = [
        'program_features' => 'array',
        'about_program' => 'array',
        'learning_forms' => 'array',
        'lvl_edu' => LevelEducational::class,
    ];

    public function directionStudy()
    {
        return $this->belongsTo(DirectionStudy::class);
    }


    public function admission_plans()
    {
        return $this->hasMany(AdmissionPlan::class, 'educational_programs_id', 'id');
    }
}
