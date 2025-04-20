<?php
// app/Http/Controllers/Admin/QuizController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function create($contentId)
    {
        $content = Content::findOrFail($contentId);
        return view('admin.quizzes.create', compact('content'));
    }
    
    public function store(Request $request, $contentId)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'passing_score' => 'required|integer|min:1|max:100',
        ]);
        
        $validated['content_id'] = $contentId;
        
        $quiz = Quiz::create($validated);
        
        return redirect()->route('admin.quizzes.questions', $quiz->id)
            ->with('success', 'Quiz created successfully. Now add questions.');
    }
    
    public function questions($quizId)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);
        return view('admin.quizzes.questions', compact('quiz'));
    }
    
    public function storeQuestion(Request $request, $quizId)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
            'correct_answer' => 'required|string|in:' . implode(',', array_keys($request->options)),
            'points' => 'required|integer|min:1',
        ]);
        
        QuizQuestion::create([
            'quiz_id' => $quizId,
            'question' => $validated['question'],
            'options' => $validated['options'],
            'correct_answer' => $validated['correct_answer'],
            'points' => $validated['points'],
        ]);
        
        return back()->with('success', 'Question added successfully.');
    }
}