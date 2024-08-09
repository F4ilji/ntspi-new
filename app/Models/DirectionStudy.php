<?php

namespace App\Models;

use App\Enums\LevelEducational;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class DirectionStudy extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $casts = [
        'lvl_edu' => LevelEducational::class,
    ];

    public function degree()
    {
        return $this->belongsTo(CampaignDegree::class, 'campaign_degree_id', 'id');
    }

    public function programs()
    {
        return $this->hasMany(EducationalProgram::class);
    }

    public function scopeWithActivePrograms(Builder $query)
    {
        return $query->with(['programs' => function ($query) {
            $query->whereHas('admission_plans.admissionCampaign', function ($q) {
                $q->where('status', 1);
            });
        }]);
    }

    public function scopeWithActiveAdmissionCampaign(Builder $query)
    {
        return $query->whereHas('programs.admission_plans.admissionCampaign', function ($q) {
            $q->where('status', 1);
        });
    }

    public function scopeForBachelorLevel(Builder $query)
    {
        return $query->where('lvl_edu', LevelEducational::BACHELOR);
    }

    public function scopeForMiddleLevel(Builder $query)
    {
        return $query->whereIn('lvl_edu', [LevelEducational::MIDDLE_LEVEL_SPECIALIST_TRAINING, LevelEducational::PREPARATION_OF_QUALIFIED_WORKERS]);
    }

    public function scopeForMasterLevel(Builder $query)
    {
        return $query->where('lvl_edu', LevelEducational::MASTER);
    }
}
