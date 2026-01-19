<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;
use App\Models\ExamAttempt;
use App\Models\ExamAnswer;

class AdminExamResultController extends Controller
{
    public function results()
    {
        $results = ExamResult::with(['user', 'exam'])
            ->latest()
            ->get();

        return view('admin.exam-results', compact('results'));
    }

    public function destroy($id)
{
    $result = ExamResult::findOrFail($id);

    // ✅ DELETE ANSWERS
    ExamAnswer::where('user_id', $result->user_id)
        ->where('exam_id', $result->exam_id)
        ->delete();

    // ✅ RESET ATTEMPT (THIS IS THE KEY)
    ExamAttempt::where('user_id', $result->user_id)
        ->where('exam_id', $result->exam_id)
        ->delete();

    // ✅ DELETE RESULT
    $result->delete();

    return back()->with(
        'success',
        'Exam result deleted. User can now retake the exam.'
    );
}

    public function show($id)
    {
        $result = ExamResult::with([
            'user',
            'exam.questions.options'
        ])->findOrFail($id);


        // ✅ KEY BY QUESTION ID
        $answers = ExamAnswer::where('user_id', $result->user_id)
            ->where('exam_id', $result->exam_id)
            ->get()
            ->keyBy('question_id');

        return view(
            'admin.exam-results-view',
            compact('result', 'answers')
        );
    }

}
