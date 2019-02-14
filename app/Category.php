<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use \Dimsav\Translatable\Translatable;

    protected $table = 'categories';
    protected $guarded = ['id'];
    public $translatedAttributes = ['name'];
}
