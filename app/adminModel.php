<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adminModel extends Model
{
protected $fillable = [
    'title',
    'author',
    'description',
    'quantity',    
    ];
}
