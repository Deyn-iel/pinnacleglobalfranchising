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
    /* ===============================
       EXAM SELECTION
    =============================== */
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

    /* ===============================
       START EXAM (WITH ATTEMPT LIMIT)
    =============================== */
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

        // ❌ already attempted
        if ($attempt && $attempt->attempt_count >= 1) {
            return view('user-dashboard.exam.exam-done');
        }

        // ✅ create attempt if not exists
        if (!$attempt) {
            $attempt = ExamAttempt::create([
                'user_id'       => $userId,
                'exam_id'       => $exam->id,
                'attempt_count' => 0,
                'started_at'    => now(), // 🔥 KEY FIX
            ]);
        }

        // 🔁 ensure started_at exists (refresh safe)
        if (!$attempt->started_at) {
            $attempt->started_at = now();
            $attempt->save();
        }

        // load questions + options
        $exam->load('questions.options');
        $exam->timer = $exam->timer ?? 60;

        return view('user-dashboard.exam.exam', [
            'exam' => $exam,
            'attempt' => $attempt,
            'questionStartedAt' => $attempt->started_at, // ✅ NOW DEFINED
             'freshAttempt' => $attempt->attempt_count == 0
        ]);
    }

    /* ===============================
       SUBMIT EXAM (FINAL + STABLE)
    =============================== */
    public function submit(Request $request)
    {
        $exam = Exam::with('questions.options')->findOrFail($request->exam_id);
        $userId = Auth::id();

        DB::transaction(function () use ($exam, $userId, $request) {

            /* ===============================
               INCREMENT ATTEMPT COUNT
            =============================== */
            $attempt = ExamAttempt::where('user_id', $userId)
                ->where('exam_id', $exam->id)
                ->first();

            if ($attempt) {
                $attempt->increment('attempt_count');
            }

            /* ===============================
               GET ANSWERS FROM JS
               FORMAT MUST BE:
               { question_id : answer }
            =============================== */
            $answers = json_decode($request->answers, true);
            $answers = is_array($answers) ? $answers : [];

            $score = 0;

            /* ===============================
               SAVE ANSWERS PER QUESTION
            =============================== */
            foreach ($exam->questions as $question) {

                // 🔥 VERY IMPORTANT (KEY BY QUESTION ID)
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

                // ✅ AUTO SCORE (MCQ & TRUE/FALSE ONLY)
                if (
                    $question->type !== 'essay' &&
                    $userAnswer !== null &&
                    (int)$userAnswer === (int)$question->correct_option
                ) {
                    $score++;
                }
            }

            /* ===============================
               SAVE EXAM RESULT SUMMARY
            =============================== */
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
}
