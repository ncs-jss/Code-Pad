<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramRecord extends Model
{
    use SoftDeletes;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'compiler_record';

    protected $fillable = [
        'name',
        'code',
        'description',
        'instructions',
        'starttime',
        'endtime',
        'start',
        'end',
        'uploaded_by',
        'upload_id'
    ];

    /**
     * For Softdelete.
     *
     * @var boollen
     */
    protected $softDeletes = true;



}
