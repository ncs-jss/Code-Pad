<?php

use Illuminate\Database\Seeder;
use App\teacher;
use App\student;
use App\student_details;
use App\teacher_details;

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
    	$student->admision_no = "15cse075";
    	$student->password = Hash::make('helloworld');
    	if($student->save())
        {
            $result=Student::where('admision_no','15cse075')->get();
            foreach ($result as $row) {
                $id=$row->id;
            }

            $student_details= new Student_details;
            $student_details->student_id = $id;
            $student_details->save();
        }

    	$teacher = new Teacher;
    	$teacher->name = "Teacher";
    	$teacher->email = "teacher@jssaten.com";
    	$teacher->password = Hash::make('helloworld');
    	if($teacher->save())
        {
            $result=Teacher::where('email','teacher@jssaten.com')->get();
            foreach ($result as $row) {
                $id=$row->id;
            }

            $teacher_details= new Teacher_Details;
            $teacher_details->teacher_id = $id;
            $teacher_details->save();
        }

        // $this->call(UsersTableSeeder::class);
    }
}
