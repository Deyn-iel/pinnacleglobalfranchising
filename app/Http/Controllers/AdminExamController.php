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

    $exam->update([
        'title' => $request->title,
        'timer' => $request->timer
    ]);

    // 🔥 DELETE QUESTIONS
    if ($request->has('deleted_questions')) {
        ExamQuestion::whereIn('id', $request->deleted_questions)->each(function ($q) {
            $q->options()->delete();
            $q->delete();
        });
    }

    // 🔥 UPDATE EXISTING QUESTIONS
    foreach ($exam->questions as $index => $question) {
        if (!isset($request->questions[$index])) continue;

        $question->update([
            'question' => $request->questions[$index],
            'correct_option' => $request->correct[$index]
        ]);

        foreach ($question->options as $oIndex => $option) {
            $option->update([
                'option_text' => $request->options[$index][$oIndex]
            ]);
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
