<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminStudentListController extends Controller
{
    public function student_list()
    {
        $students = student::select('id','name','course')
                        ->where('id','!=',1)
                        ->with('user:student_id,email')
                        ->orderBy('name','ASC')
                        ->paginate(10);
        // return $students;
        return view('/admin/student-list')->with('students',$students);
    }

    public function student_details (student $student)
    {
        $courses = Course::orderBy('course')->get();
        $student_details = student::select('id','name','course')
                    ->where('id',$student->id)
                    ->with('user:student_id,email')
                    ->get();
        return view('/admin/student-details')
                ->with([
                    'student_details' => $student_details,
                    'courses'         => $courses
                    ]);
    }

    public function student_update(Request $request, student $student, User $user)
    {
        $courses = Course::orderBy('course')->get();
        $student_details = student::select('id','name','course')
                    ->where('id',$student->id)
                    ->with('user:student_id,email')
                    ->get();

        $name = $request->input('name');
        $email = $request->input('email');
        $course = $request->input('course');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');

        // $user_email = User::where('email', '=', $email)->exists();

        // if ($user_email) {
        //     return redirect()->back()->withErrors(
        //         [
        //             'email' => ['Email is already use.']
        //         ]);
        // }

        $validatedData = request()->validate([
            'name'             => 'required|string|max:30',
            'email'            => 'required|string|max:30',
            'course'           => 'required|string|max:30',
            'password'         => 'required|min:5|max:30',
            'confirm_password' => 'required|min:5|max:30'
            ]);

            if($password == $confirm_password)
            {
                $student->update(
                    [
                       'name'    => $validatedData['name'],
                       'course'  => $validatedData['course']
                    ]);
                $user->update(
                    [
                        'name'   => $validatedData['name'],
                        'email'  => $validatedData['email'],
                        // 'password'   => Hash::make($validatedData['password'])
                    ]);
                
                return redirect()->back()
                        ->with([
                            'student_details' => $student_details,
                            'courses'         => $courses
                        ])
                        ->withSuccess('Student Details Updated');
            }
            else
            {
                return redirect()->back()->withErrors(
                    [
                        'confirm_password' => ['Password not match.']
                    ]);
            }
    }
}
