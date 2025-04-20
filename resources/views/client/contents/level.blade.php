@extends('client.layout')

@section('title', $content->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center mb-6">
        <a href="{{ route('client.category.show', $content->category_id) }}" class="text-indigo-600 hover:text-indigo-800 mr-4">
            ← Retour
        </a>
        <h1 class="text-2xl font-bold">{{ $content->title }}</h1>
    </div>
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
        <div class="p-6">
            <div class="prose max-w-none">
                {!! nl2br(e($content->description)) !!}
            </div>
        </div>
        
        @if($content->media->count() > 0)
        <div class="border-t">
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($content->media as $media)
                <div class="border rounded-lg overflow-hidden">
                    @if($media->type === 'image')
                    <img src="{{ asset('storage/'.$media->path) }}" alt="{{ $media->alt_text }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <p class="text-sm text-gray-600">{{ $media->alt_text }}</p>
                    </div>
                    @elseif($media->type === 'audio')
                    <div class="p-6 bg-blue-50">
                        <h4 class="font-medium mb-2 text-blue-800">Audio</h4>
                        <audio controls class="w-full">
                            <source src="{{ asset('storage/'.$media->path) }}" type="audio/mpeg">
                        </audio>
                        <p class="mt-2 text-sm text-gray-600">{{ $media->alt_text }}</p>
                    </div>
                    @elseif($media->type === 'video')
                    <video controls class="w-full">
                        <source src="{{ asset('storage/'.$media->path) }}" type="video/mp4">
                    </video>
                    <div class="p-4">
                        <p class="text-sm text-gray-600">{{ $media->alt_text }}</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
    
    @if($content->quiz)
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-indigo-600 px-6 py-4">
            <h2 class="text-xl font-bold text-white">Teste tes connaissances</h2>
        </div>
        
        <div class="p-6">
            <p class="mb-4">{{ $content->quiz->description }}</p>
            
            @if($userProgress->where('content_id', $content->id)->first()?->completed)
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">Tu as déjà complété ce quiz avec un score de {{ $userProgress->where('content_id', $content->id)->first()->score }}%</span>
                </div>
                <a href="{{ route('client.quiz.start', $content->id) }}" class="mt-2 inline-block text-sm text-green-700 hover:text-green-800">
                    Voulez-vous réessayer ?
                </a>
            </div>
            @endif
            
            <a href="{{ route('client.quiz.start', $content->id) }}" class="inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Commencer le quiz
            </a>
        </div>
    </div>
    @endif
</div>
@endsection