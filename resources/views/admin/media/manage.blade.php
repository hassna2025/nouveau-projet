@extends('admin.layout')

@section('title', 'Gestion des Médias')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold">Médias pour : {{ $content->title }}</h3>
            <a href="{{ route('admin.contents.index') }}" class="text-indigo-600 hover:text-indigo-900">
                Retour aux contenus
            </a>
        </div>
    </div>
    
    <!-- Upload Form -->
    <div class="p-6 border-b">
        <form action="{{ route('admin.media.upload', $content->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="flex items-center space-x-4">
                <div class="flex-1">
                    <input type="file" name="file" id="file" required
                        class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-indigo-50 file:text-indigo-700
                        hover:file:bg-indigo-100">
                </div>
                
                <div>
                    <select name="type" id="type" required
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="image">Image</option>
                        <option value="audio">Audio</option>
                        <option value="video">Vidéo</option>
                    </select>
                </div>
                
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Uploader
                </button>
            </div>
        </form>
    </div>
    
    <!-- Media List -->
    <div class="divide-y divide-gray-200">
        @foreach($content->media as $media)
        <div class="flex items-center justify-between p-4 hover:bg-gray-50">
            <div class="flex items-center space-x-4">
                @if($media->type === 'image')
                <img src="{{ asset('storage/'.$media->path) }}" alt="{{ $media->alt_text }}" class="h-16 w-16 object-cover rounded">
                @elseif($media->type === 'audio')
                <div class="h-16 w-16 bg-blue-100 rounded flex items-center justify-center">
                    <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                    </svg>
                </div>
                @elseif($media->type === 'video')
                <div class="h-16 w-16 bg-red-100 rounded flex items-center justify-center">
                    <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                @endif
                
                <div>
                    <h4 class="font-medium capitalize">{{ $media->type }}</h4>
                    <p class="text-sm text-gray-500">{{ $media->alt_text }}</p>
                    <p class="text-xs text-gray-400">{{ $media->created_at->diffForHumans() }}</p>
                </div>
            </div>
            
            <form action="{{ route('admin.media.destroy', $media->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-900">
                    Supprimer
                </button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection