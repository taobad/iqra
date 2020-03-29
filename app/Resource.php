<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Authenticatable
{
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'parent_id',
    ];

    public function group_access()
    {
        return $this->hasMany('App\ResourceGroupAccess');
    }

    /*public function hasRole($role){
        if($this->roles()->where('name',$role)->first()){
          return true;
        }
        return false;
    }*/

}
