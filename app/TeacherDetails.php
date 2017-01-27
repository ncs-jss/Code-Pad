<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherDetails extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'teachers_details';

    protected $fillable = [
        'photo_path',
        'department',
        'position',
        'mobile',
        'gender',
        'teacher_id'
    ];
}
