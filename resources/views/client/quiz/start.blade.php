@extends('client.layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-8">
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-indigo-600 mb-2">Quiz : {{ $content->quiz->title }}</h2>
        <p class="text-gray-600">{{ $content->quiz->description }}</p>
        <div class="mt-4 p-4 bg-indigo-50 rounded-lg inline-block">
            <p class="text-indigo-700">Score minimum pour réussir : {{ $content->quiz->passing_score }}%</p>
        </div>
    </div>
    
    <div class="bg-blue-50 p-6 rounded-lg mb-8">
        <h3 class="text-lg font-semibold mb-4 text-blue-800">Instructions</h3>
        <ul class="list-disc list-inside space-y-2 text-blue-700">
            <li>Ce quiz contient {{ $content->quiz->questions->count() }} questions</li>
            <li>Chaque question a une seule bonne réponse</li>
            <li>Tu ne peux pas revenir en arrière après avoir répondu</li>
            <li>Bonne chance !</li>
        </ul>
    </div>
    
    <div class="text-center">
        <a href="{{ route('client.quiz.question', ['quizId' => $content->quiz->id, 'questionNum' => 1]) }}" 
           class="px-8 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 inline-block">
            Commencer le quiz
        </a>
    </div>
</div>
@endsection