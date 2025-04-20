@extends('client.layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-8">
    <div class="mb-6 flex justify-between items-center">
        <span class="text-sm font-medium text-indigo-600">
            Question {{ $questionNum }} sur {{ $totalQuestions }}
        </span>
        <span class="text-sm font-medium">
            Score actuel : {{ $currentScore }}%
        </span>
    </div>
    
    <div class="mb-8">
        <div class="w-full bg-gray-200 rounded-full h-2.5">
            <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ ($questionNum / $totalQuestions) * 100 }}%"></div>
        </div>
    </div>
    
    <form action="{{ route('client.quiz.answer', $quiz->id) }}" method="POST">
        @csrf
        <input type="hidden" name="question_id" value="{{ $question->id }}">
        <input type="hidden" name="question_num" value="{{ $questionNum }}">
        
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-4">{{ $question->question }}</h3>
            
            <div class="space-y-3">
                @foreach($question->options as $key => $option)
                <label class="flex items-center space-x-3 p-4 border rounded-lg hover:bg-indigo-50 cursor-pointer">
                    <input type="radio" name="answer" value="{{ $key }}" required
                        class="h-5 w-5 text-indigo-600 focus:ring-indigo-500">
                    <span class="text-gray-700">{{ $option }}</span>
                </label>
                @endforeach
            </div>
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                {{ $questionNum === $totalQuestions ? 'Terminer le quiz' : 'Question suivante' }}
            </button>
        </div>
    </form>
</div>
@endsection