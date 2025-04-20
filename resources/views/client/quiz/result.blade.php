@extends('client.layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-8 text-center">
    @if($passed)
    <div class="mb-6 text-green-500">
        <svg class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h2 class="text-2xl font-bold mt-4">Félicitations !</h2>
        <p class="text-lg">Tu as réussi le quiz avec un score de {{ round($score) }}%</p>
    </div>
    @else
    <div class="mb-6 text-red-500">
        <svg class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h2 class="text-2xl font-bold mt-4">Presque !</h2>
        <p class="text-lg">Ton score : {{ round($score) }}% (il fallait {{ $quiz->passing_score }}% pour réussir)</p>
    </div>
    @endif
    
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-4">Récapitulatif</h3>
        <div class="bg-gray-50 p-4 rounded-lg inline-block">
            <p><span class="font-medium">Quiz :</span> {{ $quiz->title }}</p>
            <p><span class="font-medium">Questions :</span> {{ $totalQuestions }}</p>
            <p><span class="font-medium">Score :</span> {{ round($score) }}%</p>
        </div>
    </div>
    
    <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="{{ route('client.content.show', $quiz->content_id) }}" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            Retour au contenu
        </a>
        @if(!$passed)
        <a href="{{ route('client.quiz.start', $quiz->content_id) }}" class="px-6 py-2 border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-50">
            Réessayer
        </a>
        @endif
    </div>
</div>

@if($passed)
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Jouer un son de réussite
        const audio = new Audio('/assets/audio/success.mp3');
        audio.volume = 0.3;
        audio.play().catch(e => console.log("Audio play prevented:", e));
        
        // Animation de confetti (si la librairie est incluse)
        if (window.confetti) {
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 }
            });
        }
    });
</script>
@endpush
@endif
@endsection