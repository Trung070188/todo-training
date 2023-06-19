<?php

namespace App\Repositories\Users;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Repositories\Users\Enums\Roles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, FilterTrait;

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
    public function user_roles()
    {
        return $this->hasMany(UserRoles::class,'user_id');
    }
    public function queryUser()
    {
        $user = $this->user_roles->pluck('role_id');
        return $user;
    }


    public function isAdmin()
    {
        foreach ($this->queryUser() as $role)
        {
            if($role == Roles::ADMIN->value )
            {
                return true;
            }
        }
        return  false;

    }

}
