<!-- resources/views/client/categories/index.blade.php -->
@extends('client.layout')

@section('content')
<div class="container">
    <h2>Choisis une catégorie</h2>
    
    <div class="categories-grid">
        @foreach($categories as $category)
        <a href="{{ route('client.category.show', $category->id) }}" class="category-card">
            <div class="category-icon">{{ $category->icon }}</div>
            <h3>{{ $category->name }}</h3>
        </a>
        @endforeach
    </div>
</div>
@endsection