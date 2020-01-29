<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workplace extends Model
{
    protected $fillable = [
        'admin_id', 'title',
    ];

    public function admin(){
        return $this->belongsTo('App\User','admin_id','id');
    }
    public function products(){
        return $this->hasMany('App\Product');
    }
}
