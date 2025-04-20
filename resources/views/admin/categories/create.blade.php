@extends('admin.layout')

@section('title', 'Ajouter une Catégorie')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-2xl mx-auto">
    <h3 class="text-lg font-semibold mb-6">Ajouter une nouvelle catégorie</h3>
    
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="name" id="name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            </div>
            
            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700">Icône (emoji)</label>
                <input type="text" name="icon" id="icon"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700">Ordre d'affichage</label>
                <input type="number" name="order" id="order" min="0"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border rounded-md text-gray-700 hover:bg-gray-50">Annuler</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Enregistrer</button>
        </div>
    </form>
</div>
@endsection