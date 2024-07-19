<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramExam extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function program()
    {
        return $this->belongsTo(EducationalProgram::class);
    }
}
