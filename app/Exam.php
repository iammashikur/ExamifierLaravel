<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'id', 'name', 'data' , 'status', 'examiner_id'
    ];
}
