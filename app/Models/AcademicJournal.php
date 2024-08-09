<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicJournal extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $casts = [
        'main_info' => 'array',
        'chief_editor' => 'array',
        'editors' => 'array',
        'for_authors' => 'array',
    ];

    public function journals()
    {
        return $this->hasMany(JournalIssue::class);
    }
}
