<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamResult;
use App\Models\ExamAnswer;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Carbon\Carbon;

if (!function_exists('cleanText')) {
    function cleanText($text) {
        return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8');
    }
}


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

    public function toggle(Exam $exam)
{
    $exam->update([
        'is_active' => ! $exam->is_active
    ]);

    return back()->with(
        'success',
        $exam->is_active
            ? 'Exam ENABLED'
            : 'Exam DISABLED'
    );
}
public function exportDoc($id)
{
    $result = ExamResult::with([
        'user',
        'exam.questions.options',
    ])->findOrFail($id);

    $answers = ExamAnswer::where('exam_id', $result->exam_id)
        ->where('user_id', $result->user_id)
        ->get()
        ->keyBy('question_id');

    // IMPORTANT: clear buffer
    if (ob_get_length()) {
        ob_end_clean();
    }

    $phpWord = new PhpWord();
    $phpWord->setDefaultFontName('Arial');
    $phpWord->setDefaultFontSize(11);

    $section = $phpWord->addSection();

    /* ===== HEADER ===== */
    $section->addText(
        cleanText("Exam Result"),
        ['bold' => true, 'size' => 16]
    );

    $section->addText("User: " . cleanText($result->user->name));
    $section->addText("Exam: " . cleanText($result->exam->title));
    $section->addText("Score: {$result->score}");
    $section->addText(
    "Date: " .
    $result->created_at
        ->copy()
        ->addHours(8)
        ->format('M d, Y h:i A')
);

    $section->addTextBreak(1);

    /* ===== QUESTIONS ===== */
    foreach ($result->exam->questions as $i => $question) {

        $answer = $answers[$question->id]->answer ?? null;

        $section->addText(
            ($i + 1) . ". " . cleanText($question->question),
            ['bold' => true]
        );

        if ($question->type === 'mcq') {
            $userOpt = $question->options->firstWhere('id', $answer);
            $correctOpt = $question->options->firstWhere('id', $question->correct_option);

            $section->addText("User Answer: " . cleanText($userOpt->option_text ?? 'No answer'));
            $section->addText("Correct Answer: " . cleanText($correctOpt->option_text ?? 'Not set'));

            $section->addText(
                ((int)$answer === (int)$question->correct_option)
                    ? "Status: CORRECT"
                    : "Status: WRONG"
            );
        }

        if ($question->type === 'true_false') {
            $section->addText("User Answer: " . ($answer == 1 ? 'True' : 'False'));
            $section->addText("Correct Answer: " . ($question->correct_option == 1 ? 'True' : 'False'));
        }

        if ($question->type === 'essay') {
            $section->addText("User Answer:");
            $section->addText(cleanText($answer ?: 'No answer submitted'));
            $section->addText("Status: MANUAL CHECKING REQUIRED");
        }

        $section->addTextBreak(1);
    }

    // clean exam title
$examTitle = preg_replace('/[^A-Za-z0-9_-]/', '_', $result->exam->title);

// clean user name
$userName = preg_replace('/[^A-Za-z0-9_-]/', '_', $result->user->name);

// build file name
$fileName = "Exam_Result_{$examTitle}_{$userName}.docx";

// save path
$tempPath = storage_path("app/{$fileName}");

$writer = IOFactory::createWriter($phpWord, 'Word2007');
$writer->save($tempPath);

return response()
    ->download($tempPath)
    ->deleteFileAfterSend(true);

}


}
