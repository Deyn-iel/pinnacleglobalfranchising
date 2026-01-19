<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamResult;

class AdminExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with('questions')->get();
        return view('admin.uploading-exams', compact('exams'));
    }

    /* ===============================
       STORE EXAM (WORKING)
    =============================== */
    public function store(Request $request)
    {
        $exam = Exam::create([
            'title' => $request->title,
            'timer' => $request->timer
        ]);

        foreach ($request->questions as $index => $questionText) {

            if (trim($questionText) === '') continue;

            $type = $request->type[$index] ?? 'essay';
            $correctIndex = $request->correct[$index] ?? null;

            $question = $exam->questions()->create([
                'question' => $questionText,
                'type' => $type,
                'correct_option' => null,
            ]);

            /* ===== MCQ (FIXED) ===== */
            if ($type === 'mcq' && isset($request->options[$index])) {

                $correctOptionId = null;
                $position = 1;

                foreach ($request->options[$index] as $opt) {

                    if (trim($opt) === '') {
                        $position++;
                        continue;
                    }

                    $option = $question->options()->create([
                        'option_text' => $opt
                    ]);

                    if ((int)$correctIndex === $position) {
                        $correctOptionId = $option->id;
                    }

                    $position++;
                }

                $question->update([
                    'correct_option' => $correctOptionId
                ]);
            }

            /* ===== TRUE / FALSE ===== */
            if ($type === 'true_false') {
                $question->update([
                    'correct_option' => (int) ($correctIndex ?? 0)
                ]);
            }
        }

        return back()->with('success', 'Exam uploaded successfully!');
    }

    /* ===============================
       DELETE EXAM
    =============================== */
    public function delete($id)
    {
        Exam::findOrFail($id)->delete();
        return back()->with('success', 'Exam deleted successfully!');
    }

    /* ===============================
       EDIT EXAM
    =============================== */
    public function edit($id)
    {
        $exam = Exam::with('questions.options')->findOrFail($id);
        return view('admin.exams.edit', compact('exam'));
    }

    /* ===============================
       UPDATE EXAM (FIXED MCQ)
    =============================== */
    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);

        // ================= ADD NEW QUESTIONS =================
if ($request->has('new_questions')) {

    foreach ($request->new_questions as $data) {

        $question = $exam->questions()->create([
            'question' => $data['question'],
            'type'     => $data['type'],
        ]);

        // MULTIPLE CHOICE
        if ($data['type'] === 'mcq') {

            foreach ($data['options'] as $index => $opt) {
                $option = $question->options()->create([
                    'option_text' => $opt
                ]);

                if (($index + 1) == $data['correct']) {
                    $question->correct_option = $option->id;
                }
            }

            $question->save();
        }

        // TRUE / FALSE
        if ($data['type'] === 'true_false') {
            $question->correct_option = $data['correct'];
            $question->save();
        }

        // ESSAY → walang correct option
}
}

        $exam->update([
            'title' => $request->title,
            'timer' => $request->timer,
        ]);

        /* DELETE REMOVED QUESTIONS */
        if ($request->filled('deleted_questions')) {
            ExamQuestion::whereIn('id', $request->deleted_questions)->delete();
        }

        foreach ($request->questions as $qid => $questionText) {

            if (trim($questionText) === '') continue;

            $type = $request->type[$qid] ?? 'essay';
            $correctIndex = $request->correct[$qid] ?? null;

            $question = ExamQuestion::find($qid);
            if (!$question) continue;

            $question->update([
                'question' => $questionText,
                'type' => $type,
                'correct_option' => null
            ]);

/* ===== MCQ (FINAL FIX — EXISTING QUESTIONS) ===== */
if ($type === 'mcq' && isset($request->options[$qid])) {

    // clear old options
    $question->options()->delete();

    $correctOptionId = null;
    $position = 1;

    foreach ($request->options[$qid] as $opt) {

        if (trim($opt) === '') continue;

        $option = $question->options()->create([
            'option_text' => $opt
        ]);

        if ((int)$correctIndex === $position) {
            $correctOptionId = $option->id;
        }

        $position++;
    }

    $question->update([
        'correct_option' => $correctOptionId
    ]);
}




            /* ===== TRUE / FALSE ===== */
            if ($type === 'true_false') {
                $question->update([
                    'correct_option' => (int) ($correctIndex ?? 0)
                ]);
            }
        }

        return redirect()
            ->route('admin.uploading-exams')
            ->with('success', 'Exam updated successfully.');
    }

    /* ===============================
       RESULTS
    =============================== */
    public function results()
    {
        $results = ExamResult::with(['user', 'exam'])
            ->latest()
            ->get();

        return view('admin.exam-results', compact('results'));
    }
}
