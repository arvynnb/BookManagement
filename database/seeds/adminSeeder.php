<?php

use App\Models\User;
use App\Models\student;
use Illuminate\Database\Seeder;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $student = Student::create([
                            'name'    => 'Admin',
                            'course'  => "IT",
                            'user_id' => 1
                            ]);

            User::create([
                'name'       => 'Admin',
                'email'      => 'admin@gmail.com',
                'role'       => '1',
                'password'   => Hash::make('admin'),
                'student_id' => 1,
                'remember_token' => hash::make(str_random(10)),
            ]);

    }
}
