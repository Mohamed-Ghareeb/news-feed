<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use \Dimsav\Translatable\Translatable;

    protected $table = 'countries';
    protected $guarded = [];
    public $translatedAttributes = ['name'];
}
