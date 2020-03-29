<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResourceGroupAccess extends Model
{
    //
    protected $fillable = [
        'access_type', // RESOURCE_OWNER, RESOURCE_USER
        'resource_id',
        'group_id',
    ];

    public function resource()
    {
        return $this->belongsTo('App\Resource');
    }

    public function group()
    {
        return $this->belongsTo('App\Role');
    }
}