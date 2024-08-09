<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionPlan extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $casts = [
        'exams' => 'array',
        'contests' => 'array'
    ];

    public function educationalProgram()
    {
        return $this->belongsTo(EducationalProgram::class, 'educational_programs_id', 'id');
    }

    public function admissionCampaign()
    {
        return $this->belongsTo(AdmissionCampaign::class, 'admission_campaigns_id', 'id');
    }
}
