<?php

use Illuminate\Database\Seeder;
use App/teacher;
use App/student;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$student = new Student;
    	$student->name = "Student";
    	$student->email = "student@jssaten.com";
    	$student->password = Hash::make('helloworld');
    	$student->save;

    	$teacher = new Teacher;
    	$teacher->name = "Teacher";
    	$teacher->email = "teacher@jssaten.com";
    	$teacher->password = Hash::make('helloworld');
    	$teacher->save;

        // $this->call(UsersTableSeeder::class);
    }
}
