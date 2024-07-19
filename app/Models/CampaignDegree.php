<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignDegree extends Model
{
    use HasFactory;
    
    protected $guarded = false;

    public function campaign()
    {
       return $this->belongsTo(AdmissionCampaign::class);
    }

    public function directionStudies()
    {
        return $this->hasMany(DirectionStudy::class);
    }

    public function directionStudiesHasPrograms()
    {
        return $this->hasMany(DirectionStudy::class)->has('programs');
    }

}
