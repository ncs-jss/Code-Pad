<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramRecord extends Model
{
    protected $table='compiler_record';
    protected $softDelete=true;
}
