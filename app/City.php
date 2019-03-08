<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use \Dimsav\Translatable\Translatable;
    use SoftDeletes;
    
    protected $table = 'cities';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public $translatedAttributes = ['name'];
    // protected $with = ['country'];


    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }

}
