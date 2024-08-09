<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionCampaign extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function degrees()
    {
        return $this->hasMany(CampaignDegree::class);
    }
    public function admission_plans()
    {
        return $this->hasMany(AdmissionPlan::class, 'admission_campaigns_id', 'id');
    }

    public function educationalPrograms()
    {
        return $this->hasManyThrough(
            EducationalProgram::class,
            AdmissionPlan::class,
            'admission_campaigns_id', // внешний ключ в AdmissionPlan
            'id',                     // внешний ключ в EducationalPrograms
            'id',                     // локальный ключ в AdmissionCampaign
            'educational_programs_id' // локальный ключ в AdmissionPlan
        );
    }
}
