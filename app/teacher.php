<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Authenticatable
{
    protected $table='teacher';

    protected $fillable =['name','email','password'];

}
