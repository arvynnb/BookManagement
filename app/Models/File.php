<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = [];

    public function book()
    {
        return $this->hasOne('App\Models\Book','id','source_id');
    }
}
