@extends('admin.layout')

@section('title', 'Uploader un Média')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
    <h3 class="text-lg font-semibold mb-6">Uploader un nouveau média</h3>
    
    <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="space-y-6">
            <div>
                <label for="file" class="block text-sm font-medium text-gray-700">Fichier</label>
                <input type="file" name="file" id="file" required
                    class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-indigo-50 file:text-indigo-700
                    hover:file:bg-indigo-100">
                <p class="mt-1 text-sm text-gray-500">Formats supportés: JPG, PNG, MP3, MP4</p>
            </div>
            
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Type de média</label>
                <select name="type" id="type" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Sélectionnez un type</option>
                    <option value="image">Image</option>
                    <option value="audio">Audio</option>
                    <option value="video">Vidéo</option>
                </select>
            </div>
            
            <div>
                <label for="alt_text" class="block text-sm font-medium text-gray-700">Texte alternatif</label>
                <input type="text" name="alt_text" id="alt_text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <p class="mt-1 text-sm text-gray-500">Description pour l'accessibilité</p>
            </div>
            
            <div>
                <label for="content_id" class="block text-sm font-medium text-gray-700">Associer à un contenu (optionnel)</label>
                <select name="content_id" id="content_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Aucune association</option>
                    @foreach($contents as $content)
                    <option value="{{ $content->id }}">{{ $content->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('admin.media.index') }}" class="px-4 py-2 border rounded-md text-gray-700 hover:bg-gray-50">
                Annuler
            </a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Uploader le média
            </button>
        </div>
    </form>
</div>
@endsection