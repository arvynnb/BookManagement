<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Excel;

class ExportController extends Controller
{
    public function books_export() 
    {
        $books = Book::select('title','author','description','image','quantity','created_at')
                    ->get()
                    ->toArray();
        // return $books;
        return Excel::create('book_list', function($excel) use ($books) {
            $excel->sheet('books', function($sheet) use ($books)
            {
                $sheet->fromArray($books);
                $sheet->row(1, array(
                    'Title',
                    'Author',
                    'Description',
                    'Image',
                    'Quantity',
                    'Created_at'
                ));

                $sheet->row(1, function ($row) {
                    $row->setFontWeight('bold');
                });
            });
        })->export('xls');
    }

    public function students_export() 
    {
        $students = student::select('id','name','course','created_at')
                    ->where('id','!=',1)
                    ->with('user:student_id,email')
                    ->get();
                    // ->toArray();
        // return $students;
        // foreach ($students as $student) {
        //     return $student->name;
        // }

        return Excel::create('student_list', function($excel) use ($students) {
            $excel->sheet('students', function($sheet) use ($students)
            {
                $rows = [];
                foreach ($students as $student_list) {
                    array_push($rows,[
                        $student_list->name,
                        $student_list->course,
                        $student_list->user->email,
                        $student_list->created_at,
                        ]);
                }
                $sheet->fromArray($rows);
                $sheet->row(1, array(
                    'Name',
                    'Course',
                    'Email',
                    'Created_at'
                ));

                $sheet->row(1, function ($row) {
                    $row->setFontWeight('bold');
                });
            });
        })->export('xls');
    }
}
