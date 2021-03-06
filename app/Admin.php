<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'profile_image',
    ];

    protected $appends = ['image_path'];
    protected $dates = ['deleted_at'];

    public function getImagePathAttribute()
    {
        return asset($this->profile_image);
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFirstNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getLastNameAttribute($value)
    {
        return ucwords($value);
    }
}
