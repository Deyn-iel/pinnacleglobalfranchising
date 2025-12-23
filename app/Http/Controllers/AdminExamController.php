<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamOption;
use App\Models\ExamResult;

class AdminExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with('questions')->get();

        return view('admin.uploading-exams', compact('exams'));
    }


    public function store(Request $request)
    {
        $exam = Exam::create([
            'title' => $request->title,
            'timer' => $request->timer
        ]);

        foreach ($request->questions as $index => $questionText) {

            $question = $exam->questions()->create([
                'question' => $questionText,
                'correct_option' => $request->correct[$index]
            ]);

            $question->options()->createMany([
                ['option_text' => $request->option1[$index]],
                ['option_text' => $request->option2[$index]],
                ['option_text' => $request->option3[$index]],
                ['option_text' => $request->option4[$index]],
            ]);
        }

        return back()->with('success', 'Exam uploaded successfully!');
    }

    public function delete($id)
    {
        $exam = Exam::findOrFail($id);

        // Delete related data
        foreach ($exam->questions as $q) {
            $q->options()->delete(); // remove options
            $q->delete();            // remove question
        }

        $exam->delete(); // delete exam itself

        return back()->with('success', 'Exam deleted successfully!');
    }
    public function edit($id)
{
    $exam = Exam::with('questions')->findOrFail($id);
    return view('admin.exams.edit', compact('exam'));
}

public function update(Request $request, $id)
{
    $exam = Exam::findOrFail($id);

    // ✅ UPDATE EXAM INFO
    $exam->update([
        'title' => $request->title,
        'timer' => $request->timer
    ]);

    // ✅ DELETE QUESTIONS
    if ($request->filled('deleted_questions')) {
        ExamQuestion::whereIn('id', $request->deleted_questions)->each(function ($q) {
            $q->options()->delete();
            $q->delete();
        });
    }

    // ✅ HANDLE QUESTIONS (UPDATE + CREATE)
    foreach ($request->questions as $index => $questionText) {

        // ⛔ SKIP EMPTY INPUTS (IMPORTANT)
        if (trim($questionText) === '') {
            continue;
        }

        // ✅ EXISTING QUESTION
        if (!empty($request->question_ids[$index] ?? null)) {

            $question = ExamQuestion::find($request->question_ids[$index]);
            if (!$question) continue;

            $question->update([
                'question' => $questionText,
                'correct_option' => $request->correct[$index]
            ]);

            foreach ($question->options as $oIndex => $option) {
                $option->update([
                    'option_text' => $request->options[$index][$oIndex]
                ]);
            }

        }
        // 🆕 NEW QUESTION
        else {

            $newQuestion = $exam->questions()->create([
                'question' => $questionText,
                'correct_option' => $request->correct[$index]
            ]);

            foreach ($request->options[$index] as $optText) {
                $newQuestion->options()->create([
                    'option_text' => $optText
                ]);
            }
        }
    }

    return redirect()
        ->route('admin.uploading-exams')
        ->with('success', 'Exam updated successfully!');
}




public function results()
{
    $results = ExamResult::with(['user', 'exam'])
        ->latest()
        ->get();

    return view('admin.exam-results', compact('results'));
}

}
