<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;


class User extends Authenticatable
{
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function groups(){
        return $this->belongsToMany('App\Role');
    }

    public function getId()
    {
        return $this->id;
    }

    public function roles(){
      return $this->belongsToMany('App\Role');
    }

    /*public function hasAnyRole($roles){
      if(is_array($roles)){
        foreach ($roles as $role){
          if ($this->hasRole($role)){
            return true;
          }
        }
      } else {
        if ($this->hasRole($roles)){
          return true;
        }
      }
      return false;
    }
*/
    public function hasRole($role){
        if($this->roles()->where('name',$role)->first()){
          return true;
        }
        return false;
    }

}
