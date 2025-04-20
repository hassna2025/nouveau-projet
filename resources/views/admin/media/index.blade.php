@extends('admin.layout')

@section('title', 'Gestion des Médias')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b flex justify-between items-center">
        <h3 class="text-lg font-semibold">Tous les médias</h3>
        <a href="{{ route('admin.media.upload') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Uploader un média
        </a>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($media as $item)
            <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                @if($item->type === 'image')
                <img src="{{ asset('storage/'.$item->path) }}" alt="{{ $item->alt_text }}" class="w-full h-48 object-cover">
                @elseif($item->type === 'audio')
                <div class="bg-blue-50 h-48 flex items-center justify-center">
                    <svg class="h-16 w-16 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                    </svg>
                </div>
                @elseif($item->type === 'video')
                <div class="bg-red-50 h-48 flex items-center justify-center">
                    <svg class="h-16 w-16 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                @endif

                <div class="p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-medium capitalize">{{ $item->type }}</h4>
                            <p class="text-sm text-gray-500 truncate">{{ $item->alt_text }}</p>
                            <p class="text-xs text-gray-400">{{ $item->created_at->diffForHumans() }}</p>
                        </div>
                        <form action="{{ route('admin.media.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="mt-2 text-xs text-gray-500 truncate">
                        {{ $item->path }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="px-6 py-4 border-t">
        {{ $media->links() }}
    </div>
</div>
@endsection