@extends('admin.layout')

@section('title', 'Modifier le Contenu')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
    <h3 class="text-lg font-semibold mb-6">Modifier le contenu : {{ $content->title }}</h3>
    
    <form action="{{ route('admin.contents.update', $content->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
                <select name="category_id" id="category_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $content->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                <input type="text" name="title" id="title" value="{{ old('title', $content->title) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="6" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $content->description) }}</textarea>
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700">Niveau</label>
                    <select name="level" id="level" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $content->level == $i ? 'selected' : '' }}>
                            Niveau {{ $i }}
                        </option>
                        @endfor
                    </select>
                </div>
                
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700">Ordre</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $content->order) }}" min="0"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $content->is_active ? 'checked' : '' }}
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="is_active" class="ml-2 block text-sm text-gray-700">Contenu actif</label>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('admin.contents.show', $content->id) }}" class="px-4 py-2 border rounded-md text-gray-700 hover:bg-gray-50">
                Annuler
            </a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>

<div class="mt-8 bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
    <h4 class="text-md font-semibold mb-4">Gestion des médias</h4>
    <a href="{{ route('admin.media.manage', $content->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        Gérer les médias
    </a>
</div>

@if($content->quiz)
<div class="mt-8 bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
    <h4 class="text-md font-semibold mb-4">Gestion du quiz</h4>
    <a href="{{ route('admin.quizzes.questions', $content->quiz->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Modifier le quiz
    </a>
</div>
@endif
@endsection