@extends('admin.layout')

@section('title', 'Ajouter un Contenu')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
    <h3 class="text-lg font-semibold mb-6">Ajouter un nouveau contenu</h3>
    
    <form action="{{ route('admin.contents.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
                <select name="category_id" id="category_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                <input type="text" name="title" id="title" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700">Niveau</label>
                    <select name="level" id="level" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">Niveau {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700">Ordre</label>
                    <input type="number" name="order" id="order" min="0"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" checked
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="is_active" class="ml-2 block text-sm text-gray-700">Actif</label>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('admin.contents.index') }}" class="px-4 py-2 border rounded-md text-gray-700 hover:bg-gray-50">Annuler</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Enregistrer</button>
        </div>
    </form>
</div>
@endsection