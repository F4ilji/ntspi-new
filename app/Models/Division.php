<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $casts = [
        'description' => 'array',
    ];

    public function workers()
    {
        return $this->belongsToMany(User::class, 'division_user')->withPivot(['administrativePosition', 'sort']);
    }
}
