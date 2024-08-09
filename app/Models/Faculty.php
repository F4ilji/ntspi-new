<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function workers()
    {
        return $this->belongsToMany(User::class, 'workers_faculties')->withPivot(['position'])->whereHas('userDetail');
    }



}
