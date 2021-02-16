<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    protected $table = "students_table";

    public $timestamps = false;


    protected $fillable = [
        'id',
        'name',
        'age',
        'teacher',
        'grade',
        'birthday'
    ];
}
