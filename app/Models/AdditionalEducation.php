<?php

namespace App\Models;

use App\Enums\FormEducation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalEducation extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $casts = [
        'content' => 'array',
        'form_education' => FormEducation::class,
    ];

    public function category()
    {
        return $this->belongsTo(AdditionalEducationCategory::class, 'category_id', 'id');
    }


}
