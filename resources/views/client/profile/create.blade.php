@extends('client.layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8 mt-10">
    <h2 class="text-2xl font-bold text-center text-indigo-600 mb-8">Complète ton profil</h2>
    
    <form method="POST" action="{{ route('client.profile.store') }}">
        @csrf
        
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Avatar</label>
            <div class="flex space-x-4">
                @foreach(['🐶', '🐱', '🐭', '🐹', '🐰', '🦊'] as $avatar)
                <label class="cursor-pointer">
                    <input type="radio" name="avatar" value="{{ $avatar }}" class="sr-only peer" {{ $loop->first ? 'checked' : '' }}>
                    <div class="text-4xl p-2 rounded-full peer-checked:bg-indigo-100 peer-checked:ring-2 peer-checked:ring-indigo-500">
                        {{ $avatar }}
                    </div>
                </label>
                @endforeach
            </div>
        </div>
        
        <div class="mb-6">
            <label for="favorite_color" class="block text-sm font-medium text-gray-700 mb-1">Couleur préférée</label>
            <select name="favorite_color" id="favorite_color"
                class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                <option value="indigo">Bleu</option>
                <option value="pink">Rose</option>
                <option value="purple">Violet</option>
                <option value="green">Vert</option>
                <option value="yellow">Jaune</option>
            </select>
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Commencer l'aventure !
            </button>
        </div>
    </form>
</div>
@endsection