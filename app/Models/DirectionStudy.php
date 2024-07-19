<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectionStudy extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function degree()
    {
        return $this->belongsTo(CampaignDegree::class, 'campaign_degree_id', 'id');
    }

    public function programs()
    {
        return $this->hasMany(EducationalProgram::class);
    }
}
