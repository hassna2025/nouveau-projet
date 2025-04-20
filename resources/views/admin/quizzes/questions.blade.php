@extends('admin.layout')

@section('title', 'Questions du Quiz')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold">Questions pour : {{ $quiz->title }}</h3>
            <div class="flex space-x-4">
                <a href="{{ route('admin.contents.show', $quiz->content_id) }}" class="text-indigo-600 hover:text-indigo-900">
                    Retour au contenu
                </a>
                <span class="text-gray-400">|</span>
                <span class="text-gray-600">{{ $quiz->questions->count() }} questions</span>
            </div>
        </div>
    </div>
    
    <!-- Add Question Form -->
    <div class="p-6 border-b">
        <form action="{{ route('admin.quizzes.storeQuestion', $quiz->id) }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
                    <input type="text" name="question" id="question" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="options_a" class="block text-sm font-medium text-gray-700">Option A</label>
                        <input type="text" name="options[a]" id="options_a" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label for="options_b" class="block text-sm font-medium text-gray-700">Option B</label>
                        <input type="text" name="options[b]" id="options_b" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label for="options_c" class="block text-sm font-medium text-gray-700">Option C</label>
                        <input type="text" name="options[c]" id="options_c"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label for="options_d" class="block text-sm font-medium text-gray-700">Option D</label>
                        <input type="text" name="options[d]" id="options_d"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="correct_answer" class="block text-sm font-medium text-gray-700">Réponse correcte</label>
                        <select name="correct_answer" id="correct_answer" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="a">Option A</option>
                            <option value="b">Option B</option>
                            <option value="c">Option C</option>
                            <option value="d">Option D</option>
                        </select>
                    </div>
                    <div>
                        <label for="points" class="block text-sm font-medium text-gray-700">Points</label>
                        <input type="number" name="points" id="points" min="1" value="1" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Ajouter la question
                </button>
            </div>
        </form>
    </div>
    
    <!-- Questions List -->
    <div class="divide-y divide-gray-200">
        @foreach($quiz->questions as $question)
        <div class="p-6 hover:bg-gray-50">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h4 class="font-medium">{{ $question->question }}</h4>
                    <div class="mt-3 grid grid-cols-2 gap-4">
                        @foreach($question->options as $key => $option)
                        <div class="flex items-center">
                            <span class="font-medium mr-2 {{ $key === $question->correct_answer ? 'text-green-600' : 'text-gray-600' }}">{{ strtoupper($key) }}.</span>
                            <span>{{ $option }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <form action="{{ route('admin.quizzes.destroyQuestion', $question->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection