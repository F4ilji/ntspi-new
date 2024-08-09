<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Tables\Columns\Layout\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }


    public function departments_work()
    {
        return $this->belongsToMany(Department::class, 'workers_departments')->withPivot(['position']);
    }

    public function departments_teach()
    {
        return $this->belongsToMany(Department::class, 'teachers_departments')->withPivot(['teaching_position']);
    }

    public function divisions()
    {
        return $this->belongsToMany(Division::class, 'division_user')->withPivot(['administrativePosition']);
    }

    public function faculties()
    {
        return $this->belongsToMany(Faculty::class, 'workers_faculties')->withPivot(['position']);
    }

    public function canAccessPanel(Panel|\Filament\Panel $panel): bool
    {
        return true;
    }
}
