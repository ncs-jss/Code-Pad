<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentDetails extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'students_details';

     protected $fillable = [
        'photo_path',
        'branch',
        'year',
        'email',
        'mobile',
        'gender',
        'student_id'
    ];
}
