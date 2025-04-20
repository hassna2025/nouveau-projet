@extends('client.layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8 mt-10">
    <div class="flex items-center space-x-6">
        <div class="text-6xl">
            {{ auth()->user()->avatar }}
        </div>
        
        <div>
            <h2 class="text-2xl font-bold">{{ auth()->user()->name }}</h2>
            <p class="text-gray-600">Âge: {{ auth()->user()->age }} ans</p>
            <p class="text-gray-600">Code: {{ auth()->user()->access_code }}</p>
        </div>
    </div>
    
    <div class="mt-8">
        <h3 class="text-lg font-semibold mb-4">Progression</h3>
        
        <div class="space-y-4">
            @foreach(auth()->user()->progress as $progress)
            <div>
                <div class="flex justify-between mb-1">
                    <span class="text-sm font-medium">{{ $progress->content->title }}</span>
                    <span class="text-sm">{{ $progress->completed ? '✅' : '🔄' }}</span>
                </div>
                @if($progress->quiz)
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $progress->score }}%"></div>
                </div>
                <p class="text-xs text-gray-500 mt-1">Score: {{ round($progress->score) }}%</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection