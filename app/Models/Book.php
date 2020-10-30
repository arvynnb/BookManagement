<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];

    public function borrows()
    {
        return $this->hasMany('App\Models\Borrow','book_id','id');
    }

    public function student()
    {
        return $this->belongsto('App\Models\student');
    }

    public function file()
    {
        return $this->hasOne('App\Models\File','source_id','id');
    }

    // public function getModel($model)
    // {
    //     $model = 'Book';
    //     return $this->where('model',$model)->hasOne('App\Models\File');
    // }
}


