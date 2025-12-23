<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /* ===============================
       EXAM SELECTION
    =============================== */
    public function select()
{
    $exams = Exam::withCount('questions')->get();

    // ✅ IF WALANG EXAM → BALIK DASHBOARD + WARNING
    if ($exams->isEmpty()) {
        return redirect()
            ->route('dashboard')
            ->with('error', 'No exam is available at the moment.');
    }

    // ✅ IF ISA LANG → AUTO START
    if ($exams->count() === 1) {
        return redirect()->route('exam.start', $exams->first()->id);
    }

    // ✅ NORMAL SELECT PAGE
    return view('user-dashboard.exam.select', compact('exams'));
}


    /* ===============================
       START EXAM
    =============================== */
    public function start(Exam $exam)
    {
        $exam->load('questions.options');
        $exam->timer = $exam->timer ?? 60;

        return view('user-dashboard.exam.exam', compact('exam'));
    }

    /* ===============================
       SUBMIT EXAM
    =============================== */
    public function submit(Request $request)
    {
        $exam = Exam::with('questions')->findOrFail($request->exam_id);

        $answers = json_decode($request->answers, true) ?? [];
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
            'total_questions' => $exam->questions->count(),
            'cheated' => $request->cheated == 1
        ]);

        return redirect('/dashboard')->with(
            $request->cheated == 1 ? 'error' : 'success',
            $request->cheated == 1
                ? 'Exam terminated due to cheating.'
                : 'Exam submitted successfully.'
        );
    }
}
