<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

class User extends Authenticatable
{
    use Notifiable;

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
        'block'     => 'Блоки',
        'site_type' => 'Типы сайтов',
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
            $old_image = public_path($this->attributes['avatar']);

            if ($this->attributes['avatar'] && is_file($old_image)) {
                unlink($old_image);
            }
        }

        $this->attributes['avatar'] = saveUploadedImage($image, $this->name, 'avatar');
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
