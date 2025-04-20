@extends('admin.layout')

@section('title', 'Gestion des Contenus')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b">
        <h3 class="text-lg font-semibold">Liste des Contenus</h3>
        <a href="{{ route('admin.contents.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Ajouter un contenu
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Titre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Catégorie</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Niveau</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($contents as $content)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-medium text-gray-900">{{ $content->title }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-sm bg-indigo-100 text-indigo-800 rounded-full">
                            {{ $content->category->name }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        Niveau {{ $content->level }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.contents.edit', $content) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Modifier</a>
                        <a href="{{ route('admin.contents.show', $content) }}" class="text-blue-600 hover:text-blue-900 mr-3">Voir</a>
                        <form action="{{ route('admin.contents.destroy', $content) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4 border-t">
        {{ $contents->links() }}
    </div>
</div>
@endsection