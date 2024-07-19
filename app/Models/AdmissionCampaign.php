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
}
