<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;

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
        ExamResult::findOrFail($id)->delete();

        return back()->with('success', 'Exam result deleted successfully.');
    }
}
