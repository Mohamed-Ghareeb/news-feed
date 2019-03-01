<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plans';
    protected $fillable = [
        'name',
        'price',
        'features',
        'image',
        'notification_type',
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset($this->image);
    }
}
