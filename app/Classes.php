<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    //
    protected $table = 'classes';

    public function documents(){
        return $this->hasMany('App\Document');
    }
}
