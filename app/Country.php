<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use \Dimsav\Translatable\Translatable;

    protected $table = 'countries';
    protected $guarded = ['id'];
    public $translatedAttributes = ['name'];


    public function cities()
    {
        return $this->hasMany('App\City', 'country_id');
    }



}
