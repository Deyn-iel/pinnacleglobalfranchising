<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamResult;
use Illuminate\Http\Request; // ✅ MISSING IMPORT
use Illuminate\Support\Facades\Auth;

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

    public function submit(Request $request)
{
    $exam = Exam::with('questions')->findOrFail($request->exam_id);

    $answers = json_decode($request->answers, true);
    $score = 0;

    foreach ($exam->questions as $index => $question) {
        if (
            isset($answers[$index]) &&
            $answers[$index] == $question->correct_option
        ) {
            $score++;
        }
    }

    ExamResult::create([
        'user_id' => Auth::id(),
        'exam_id' => $exam->id,
        'score' => $score,
        'total_questions' => $exam->questions->count()
    ]);

    return redirect()
        ->route('dashboard')
        ->with('success', 'Exam submitted successfully.');
}
}
