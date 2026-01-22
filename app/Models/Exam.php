<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ExamQuestion;
use App\Models\ExamResult;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'timer',
        'is_active'
    ];

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public function results()
    {
        return $this->hasMany(ExamResult::class);
    }
}
