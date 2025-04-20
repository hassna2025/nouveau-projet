@extends('admin.layout')

@section('title', 'Gestion des Catégories')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b">
        <h3 class="text-lg font-semibold">Liste des Catégories</h3>
        <a href="{{ route('admin.categories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Ajouter une catégorie
        </a>
    </div>
    <div class="divide-y divide-gray-200">
        @foreach($categories as $category)
        <div class="flex items-center justify-between p-4 hover:bg-gray-50">
            <div class="flex items-center space-x-4">
                <span class="text-2xl">{{ $category->icon }}</span>
                <div>
                    <h4 class="font-medium">{{ $category->name }}</h4>
                    <p class="text-sm text-gray-500">{{ $category->description }}</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
<h1>Liste des Catégories</h1>
<table class="table">
    @foreach($categories as $category)
    <tr>
        <td>{{ $category->name }}</td>
        <td>{{ $category->slug }}</td>
        <td>{{ $category->icon }}</td>
    </tr>
    @endforeach
</table>
@endsection