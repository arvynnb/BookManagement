<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $guarded = [];
    // public $timestamps = true;

    // public function count_book_id(Request $request)
    // {
    //     $books = App\Models\Borrow::find(1)->borrows;
    //     $book_id = $request->book_id;
    //     foreach ($counts as $count) {
    //         $count = Borrow::find(1)->book_id()->where('book_id',$book_id)->first();
    //     }
    // }

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\student');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
