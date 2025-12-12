<?php

namespace App\Http\Controllers;

use App\Models\Exam;

class ExamController extends Controller
{
    public function start()
    {
        $exam = Exam::with('questions.options')->first();

        return view('admin.user-dashboard', compact('exam'));
    }
}

