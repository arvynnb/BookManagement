<?php

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            ['course' => 'BSIT'],
            ['course' => 'BSCS'],
            ['course' => 'CBA'],
            ['course' => 'BSE']
        ];

        Course::insert($courses);
    }
}
