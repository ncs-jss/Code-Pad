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

    /**
     * For Softdelete.
     *
     * @var boollen
     */
    protected $softDeletes = true;
}
