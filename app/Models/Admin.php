<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    // protected $guarded = [];
    protected $guard = 'admin';

    protected $fillable = [
        'admin_id', 'admin_password',
    ];

    protected $hidden = [
        'admin_password',
    ];

    // Tell Laravel to use 'admin_password' as the password field
    // public function getAuthPassword()
    // {
    //     return $this->admin_password;
    // }
}

