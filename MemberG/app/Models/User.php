<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role\Role;
use App\Models\Member\Member;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'id_member',
        'username',
        'email',
        'photo_images',
        'phone',
        'password',
        'id_role',
        'isActive'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function Role()
    {
        return $this->belongsTo(Role::class,"id_role", "id");
    }
    public function Member()
    {
        return $this->belongsTo(Member::class,"id_member", "id");
    }
}
