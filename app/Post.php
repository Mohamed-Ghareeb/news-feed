<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'summary',
        'main_image',
        'images',
        'approved',
        'views',
        'category_id',
        'user_id',
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset($this->main_image);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tags', 'post_id', 'tag_id');
    }

}
