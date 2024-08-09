<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalEducationCategory extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function additionalEducations()
    {
        return $this->hasMany(AdditionalEducation::class, 'category_id', 'id');
    }

    public function direction()
    {
        return $this->belongsTo(DirectionAdditionalEducation::class, 'dir_addit_educat_id', 'id');
    }
}
