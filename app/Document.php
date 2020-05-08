<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'document_type_id',
        'class_id',
    ];

    public function assignedClass(){
        return $this->belongsTo('App\Classes','class_id','id');
    }

    public function documentType(){
        return $this->belongsTo('App\DocumentType');
    }

}
