<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use \Dimsav\Translatable\Translatable;
    use SoftDeletes;

    protected $table = 'countries';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public $translatedAttributes = ['name'];

    public function cities()
    {
        return $this->hasMany('App\City', 'country_id');
    }



}

