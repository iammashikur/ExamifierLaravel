<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentData extends Model
{


    protected $fillable = [
        'id', 'student_id', 'exam_id' , 'data'
    ];
}
