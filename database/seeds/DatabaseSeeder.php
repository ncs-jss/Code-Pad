<?php

use Illuminate\Database\Seeder;
use App\Teacher;
use App\Student;
use App\StudentDetails;
use App\TeacherDetails;
use App\Admin;

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

            $student_details= new StudentDetails;
            $student_details->student_id = $id;
            $student_details->save();
        }

    	$teacher = new Teacher;
    	$teacher->name = "Teacher";
    	$teacher->email = "teacher@jssaten.com";
    	$teacher->password = Hash::make('helloworld');
    	if($teacher->save())
        {
            $result=Teacher::where('email', 'teacher@jssaten.com')->get();
            foreach ($result as $row) {
                $id=$row->id;
            }

            $teacher_details= new TeacherDetails;
            $teacher_details->teacher_id = $id;
            $teacher_details->save();
        }
        $admin = new Admin;
        $admin->name = "Admin";
        $admin->email = "admin@admin.com";
        $admin->password = Hash::make('helloworld');
        $admin->type='1';
        $admin->save();


        // $this->call(UsersTableSeeder::class);
    }
}
