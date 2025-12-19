<?php

namespace App\Http\Controllers;

use App\Models\Exam;

class ExamController extends Controller
{
    public function start()
{
    $exam = Exam::with('questions.options')->first();

    if (!$exam) {
        return redirect()->route('dashboard')
            ->with('error', 'No exam available.');
    }

    $exam->timer = $exam->timer ?? 60;

    return view('user-dashboard.exam.exam', compact('exam'));
}

}

