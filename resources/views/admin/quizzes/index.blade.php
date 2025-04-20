@extends('admin.layout')

@section('title', 'Liste des Quiz')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b">
        <h3 class="text-lg font-semibold">Gestion des Quiz</h3>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Titre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contenu associé</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Questions</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Score de passage</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($quizzes as $quiz)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-medium text-gray-900">{{ $quiz->title }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('admin.contents.show', $quiz->content_id) }}" class="text-indigo-600 hover:text-indigo-900">
                            {{ $quiz->content->title }}
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $quiz->questions_count }} questions
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $quiz->passing_score }}%
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.quizzes.questions', $quiz->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                            Questions
                        </a>
                        <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                            Modifier
                        </a>
                        <form action="{{ route('admin.quizzes.destroy', $quiz->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Supprimer ce quiz ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Aucun quiz trouvé
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t">
        {{ $quizzes->links() }}
    </div>
</div>
@endsection