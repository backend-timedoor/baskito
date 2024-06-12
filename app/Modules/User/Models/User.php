<?php

namespace App\Modules\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Supports\Models\Concerns\HasPassword;
use App\Supports\Models\Concerns\HasRoleAndPermission;
use App\Supports\UIAvatar\UIAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method \Illuminate\Database\Eloquent\Collection<int, \jeremykenedy\LaravelRoles\Models\Role> getRoles()
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasPassword, HasRoleAndPermission, Notifiable;

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
    ];

    public function getPhotoProfileAttribute(): string
    {
        return UIAvatar::make()
            ->size(512)
            ->bold()
            ->generate($this->name);
    }

    /**
     * Determine if the user is a developer.
     */
    public function isDeveloper(): bool
    {
        return $this->email === config('auth.default_admins.dev.email');
    }
}
