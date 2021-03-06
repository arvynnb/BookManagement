<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $guarded = [];

    function borrows(){
        return $this->hasMany('App\Models\Borrow');
    }

    public function book()
    {
        return $this->hasMany('App\Models\student');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function course()
    {
        return $this->hasMany('App\Models\Course');
    }

}
