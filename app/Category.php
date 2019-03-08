<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use \Dimsav\Translatable\Translatable;
    use SoftDeletes;

    protected $table = 'categories';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public $translatedAttributes = ['name'];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}

