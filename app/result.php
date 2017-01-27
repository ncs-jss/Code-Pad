<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'result';

     protected $fillable = [
        'student_id',
        'time',
        'score',
        'attempt',
        'record_id'
    ];
}
