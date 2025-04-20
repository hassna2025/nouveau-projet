<?php
// app/Http/Controllers/ClientController.php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\Quiz;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $categories = Category::with(['contents' => function($query) {
            $query->where('is_active', true)->orderBy('level');
        }])->orderBy('order')->get();
        
        return view('client.categories.index', compact('categories'));
    }
    
    public function showCategory($id)
    {
        $category = Category::with(['contents' => function($query) {
            $query->where('is_active', true)->orderBy('level');
        }])->findOrFail($id);
        
        return view('client.categories.show', compact('category'));
    }
    
    public function showContent($id)
    {
        $content = Content::with(['media', 'quiz'])->findOrFail($id);
        $user = Auth::user();
        
        return view('client.contents.show', compact('content', 'user'));
    }
    
    public function startQuiz($contentId)
    {
        $content = Content::with('quiz.questions')->findOrFail($contentId);
        $user = Auth::user();
        
        if (!$content->quiz) {
            return back()->with('error', 'No quiz available for this content.');
        }
        
        return view('client.quiz.start', compact('content', 'user'));
    }
    
    public function submitQuiz(Request $request, $quizId)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);
        $user = Auth::user();
        
        $score = 0;
        $total = $quiz->questions->sum('points');
        
        foreach ($quiz->questions as $question) {
            $answer = $request->input('answers.'.$question->id);
            if ($answer === $question->correct_answer) {
                $score += $question->points;
            }
        }
        
        $percentage = ($score / $total) * 100;
        $passed = $percentage >= $quiz->passing_score;
        
        UserProgress::updateOrCreate(
            ['user_id' => $user->id, 'content_id' => $quiz->content_id],
            [
                'quiz_id' => $quiz->id,
                'score' => $percentage,
                'completed' => $passed,
                'completed_at' => now(),
            ]
        );
        
        return view('client.quiz.result', [
            'quiz' => $quiz,
            'score' => $percentage,
            'passed' => $passed,
            'total' => $total,
        ]);
    }
}