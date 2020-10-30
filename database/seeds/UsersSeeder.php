<?php

use App\Models\User;
use App\Models\student;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {        
        foreach (range(1,50) as $index) {
            $user_id    = User::select('id')->orderBy('id','DESC')->first();
            $student = Student::create([
                            'name'    => $faker->name,
                            'course'  => "CS",
                            'user_id' =>$user_id->id+1
                            ]);

            User::create([
                'name'       => $student->name,
                'email'      => $faker->unique()->safeEmail,
                'role'       => '0',
                'password'   => Hash::make('student'),
                'student_id' => $student->id,
                'remember_token' => hash::make(str_random(10)),
            ]);

        }   
    }
}
