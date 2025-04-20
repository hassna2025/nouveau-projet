@extends('admin.layout')

@section('title', 'Modifier le Quiz')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
    <h3 class="text-lg font-semibold mb-6">Modifier le quiz : {{ $quiz->title }}</h3>
    
    <form action="{{ route('admin.quizzes.update', $quiz->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Titre du quiz</label>
                <input type="text" name="title" id="title" value="{{ old('title', $quiz->title) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $quiz->description) }}</textarea>
            </div>
            
            <div>
                <label for="passing_score" class="block text-sm font-medium text-gray-700">Score de réussite (%)</label>
                <input type="number" name="passing_score" id="passing_score" min="1" max="100" 
                    value="{{ old('passing_score', $quiz->passing_score) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('admin.quizzes.questions', $quiz->id) }}" class="px-4 py-2 border rounded-md text-gray-700 hover:bg-gray-50">
                Retour aux questions
            </a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection