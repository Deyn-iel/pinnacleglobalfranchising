<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\ExamAttempt;
use App\Models\ExamAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExamController extends Controller
{
    public function select()
    {
        $exams = Exam::withCount('questions')->get();

        if ($exams->isEmpty()) {
            return redirect()
                ->route('dashboard')
                ->with('error', 'No exam is available at the moment.');
        }

        if ($exams->count() === 1) {
            return redirect()->route('exam.start', $exams->first()->id);
        }

        return view('user-dashboard.exam.select', compact('exams'));
    }

    public function start(Exam $exam)
    {
        if (! $exam->is_active) {
        return response()
            ->view('user-dashboard.exam.exam-disabled', [], 403);
    }

        $userId = Auth::id();

        $attempt = ExamAttempt::where('user_id', $userId)
            ->where('exam_id', $exam->id)
            ->first();

        if ($attempt && $attempt->attempt_count >= 1) {
            return view('user-dashboard.exam.exam-done');
        }

        if (!$attempt) {
            $attempt = ExamAttempt::create([
                'user_id'         => $userId,
                'exam_id'         => $exam->id,
                'attempt_count'   => 0,
                'current_question'=> 0,
                'started_at'      => now(),
            ]);
        }

        if ($attempt->current_question === null) {
            $attempt->current_question = 0;
            $attempt->save();
        }

        if (!$attempt->started_at) {
            $attempt->started_at = now();
            $attempt->save();
        }

        $exam->load('questions.options');
        $exam->timer = $exam->timer ?? 60;

        return view('user-dashboard.exam.exam', [
            'exam' => $exam,
            'attempt' => $attempt,
            'questionStartedAt' => $attempt->started_at,
            'currentQuestion' => $attempt->current_question, 
        ]);

    }

    public function submit(Request $request)
    {
        $exam = Exam::with('questions.options')->findOrFail($request->exam_id);
        $userId = Auth::id();

        DB::transaction(function () use ($exam, $userId, $request) {

            $attempt = ExamAttempt::where('user_id', $userId)
                ->where('exam_id', $exam->id)
                ->first();

            if ($attempt) {
                $attempt->increment('attempt_count');
                $attempt->update([
                    'current_question' => 0
                ]);
            }

            $answers = json_decode($request->answers, true);
            $answers = is_array($answers) ? $answers : [];

            $score = 0;
            foreach ($exam->questions as $question) {

                $userAnswer = $answers[$question->id] ?? null;

                ExamAnswer::updateOrCreate(
                    [
                        'user_id'     => $userId,
                        'exam_id'     => $exam->id,
                        'question_id'=> $question->id,
                    ],
                    [
                        'answer' => $userAnswer,
                    ]
                );

                if (
                    $question->type !== 'essay' &&
                    $userAnswer !== null &&
                    (int)$userAnswer === (int)$question->correct_option
                ) {
                    $score++;
                }
            }

            ExamResult::updateOrCreate(
                [
                    'user_id' => $userId,
                    'exam_id' => $exam->id,
                ],
                [
                    'score'           => $score,
                    'total_questions' => $exam->questions->count(),
                    'cheated'         => $request->cheated == 1,
                ]
            );
        });

        return redirect('/dashboard')->with(
            $request->cheated == 1 ? 'error' : 'success',
            $request->cheated == 1
                ? 'Exam terminated due to detected cheating. Your exam has been automatically submitted.'
                : 'Exam submitted successfully.'
        );
    }
    public function saveProgress(Request $request)
{
    ExamAttempt::where('user_id', Auth::id())
        ->where('exam_id', $request->exam_id)
        ->update([
            'current_question' => $request->current_question
        ]);

    return response()->json(['ok' => true]);
}

}
