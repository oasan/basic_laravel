<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public const ADMIN = 'admin';

    protected $fillable = [
        'name',
        'alias'
    ];
}
