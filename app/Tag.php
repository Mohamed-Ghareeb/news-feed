<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    
    protected $table = 'tags';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name'];
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}

