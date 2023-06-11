<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Coach extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
     protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];


    protected $guard_name = 'coach';

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
        'roles_name' => 'array',
    ];


    public function services() {
        return $this->hasMany(\Modules\Service\Entities\Service::class);
    }

    public function appointments() {
        return $this->hasMany(\Modules\Appointment\Entities\Appointment::class);
    }

    public function reviews() {
        return $this->hasMany(\Modules\Review\Entities\Review::class);
    }
}
