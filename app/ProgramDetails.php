<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramDetails extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'program_details';

    protected $fillable = [
        'program_name',
        'program_statement',
        'difficulty',
        'sample_input',
        'sample_output',
        'sample_explanation',
        'time',
        'marks',
        'testcases_input',
        'testcases_output',
        'record_id'
    ];
}
