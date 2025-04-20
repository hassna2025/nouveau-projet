@extends('admin.layout')

@section('title', $content->title)

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b flex justify-between items-center">
        <h3 class="text-lg font-semibold">{{ $content->title }}</h3>
        <div class="flex space-x-4">
            <span class="px-2 py-1 text-sm bg-indigo-100 text-indigo-800 rounded-full">
                {{ $content->category->name }}
            </span>
            <span class="px-2 py-1 text-sm bg-gray-100 text-gray-800 rounded-full">
                Niveau {{ $content->level }}
            </span>
        </div>
    </div>
    
    <div class="p-6">
        <div class="prose max-w-none">
            <h4>Description</h4>
            <p>{{ $content->description }}</p>
        </div>
        
        <div class="mt-8">
            <h4 class="text-lg font-medium mb-4">Médias associés</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($content->media as $media)
                <div class="border rounded-lg overflow-hidden">
                    @if($media->type === 'image')
                    <img src="{{ asset('storage/'.$media->path) }}" alt="{{ $media->alt_text }}" class="w-full h-48 object-cover">
                    @elseif($media->type === 'audio')
                    <div class="p-4 bg-blue-50">
                        <audio controls class="w-full">
                            <source src="{{ asset('storage/'.$media->path) }}" type="audio/mpeg">
                        </audio>
                    </div>
                    @elseif($media->type === 'video')
                    <video controls class="w-full">
                        <source src="{{ asset('storage/'.$media->path) }}" type="video/mp4">
                    </video>
                    @endif
                    <div class="p-3 border-t">
                        <p class="text-sm capitalize">{{ $media->type }}</p>
                        <p class="text-xs text-gray-500">{{ $media->alt_text }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                <a href="{{ route('admin.media.index', $content->id) }}" class="text-indigo-600 hover:text-indigo-900">
                    Gérer les médias →
                </a>
            </div>
        </div>
        
        @if($content->quiz)
        <div class="mt-8 pt-6 border-t">
            <h4 class="text-lg font-medium mb-4">Quiz associé</h4>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h5 class="font-medium">{{ $content->quiz->title }}</h5>
                <p class="text-sm text-gray-600">{{ $content->quiz->description }}</p>
                <p class="mt-2 text-sm">Score de passage : {{ $content->quiz->passing_score }}%</p>
                <p class="text-sm">{{ $content->quiz->questions->count() }} questions</p>
                
                <div class="mt-4">
                    <a href="{{ route('admin.quizzes.questions', $content->quiz->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">
                        Voir les questions →
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="mt-8 pt-6 border-t">
            <a href="{{ route('admin.quizzes.create', $content->id) }}" class="text-indigo-600 hover:text-indigo-900">
                Créer un quiz pour ce contenu →
            </a>
        </div>
        @endif
    </div>
    
    <div class="px-6 py-4 border-t flex justify-end">
        <a href="{{ route('admin.contents.edit', $content) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
            Modifier ce contenu
        </a>
    </div>
</div>
@endsection