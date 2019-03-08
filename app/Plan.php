<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $table = 'plans';
    protected $dates = ['deleted_at'];
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
