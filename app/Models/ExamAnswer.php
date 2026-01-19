<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    protected $fillable = [
        'user_id',
        'exam_id',
        'question_id',
        'answer'
    ];
}
