<?php

namespace App\Models;

use App\Models\Traits\ImageTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

class User extends Authenticatable
{
    use Notifiable;
    use ImageTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'permissions',
    ];

    public const PERMISSIONS = [
        'blog'      => 'Блог',
        'user'      => 'Пользователи',
        'cache'     => 'Очистить кеш',
        'settings'  => 'Настройки',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'permissions' => 'array',
    ];



    public function getIsAdminAttribute()
    {
        return (bool) $this->roles()->where('alias', Role::ADMIN)->count();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function setAvatarAttribute($image) {

        if (isset($this->attributes['avatar'])) {
            $this->deleteImage('avatar');
        }

        $this->attributes['avatar'] = $this->saveUploadedImage($image, $this->name, 'avatar');
    }

    public function getAvaAttribute()
    {
        if (!$this->attributes['avatar']) return '/uploads/user.png';

        return $this->attributes['avatar'];
    }

    public function hasPermission($permissions)
    {
        if (!$permissions) return false;
        if (!$this->permissions) return false;

        if (is_array($permissions)) {
            return count(array_intersect($permissions, $this->permissions)) == count($this->permissions);
        }

        return in_array($permissions, $this->permissions);
    }
}
