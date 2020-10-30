<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class adminCourseController extends Controller
{
    public function course_list()
    {
        $courses = Course::get();
        return view('/admin/course')->with('courses',$courses);
    }

    public function add_course(Request $request, Course $course)
    {
        $course_input = $request->input('course');
        ;
        $validatedData = request()->validate([
            'course'         => 'required|string|max:30'
            ]);

        $course_validation = Course::where('course', '=', $course_input)->exists();
        if($course_validation)
        {
            return redirect()->back()->withErrors(
                [
                    'course' => ['This course is already added.']
                ]);
        }
        Course::create(['course'=>$validatedData['course']]);
    
        return redirect()->back()->withSuccess('Course Added');
    }

    public function course_details(Course $course)
    {
        $courses = Course::where('id',$course->id)->get();
        return view('/admin/course-details')->with('courses',$courses);
    }

    public function course_update(Course $course, Request $request)
    {   
        $course_input = $request->input('course');

        $validatedData = request()->validate(['course'=>'required|string|max:30']);

        $course_validation = Course::where('course', '=', $course_input)->exists();
        if($course_validation)
        {
            return redirect()->back()->withErrors(
                [
                    'course' => ['This course is already added.']
                ]);
        }
        
        $course->update(['course'   => $validatedData['course']]);

        return redirect()->back()->withSuccess('Course Updated');

    }
}
