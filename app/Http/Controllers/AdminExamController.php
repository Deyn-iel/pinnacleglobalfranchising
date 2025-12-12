<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamOption;

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

}
