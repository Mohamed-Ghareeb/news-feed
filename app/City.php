<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use \Dimsav\Translatable\Translatable;

    protected $table = 'cities';
    protected $guarded = ['id'];
    public $translatedAttributes = ['name'];
    // protected $with = ['country'];


    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }

}
