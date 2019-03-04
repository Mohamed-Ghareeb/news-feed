<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset($this->profile_image);
    }

    protected $hidden = [
        'password', 'remember_token',
    ];
}
